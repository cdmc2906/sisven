USE [tcc_control_ruta]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

ALTER PROCEDURE [dbo].[SP_VISITAS_ACUMULADAS_MES]
@FECHA_INICIAL DATETIME,
@FECHA_FINAL DATETIME,
@EJECUTIVO VARCHAR(8)
AS 
BEGIN
SET NOCOUNT ON 
SET LANGUAGE Spanish;  
DECLARE 
	@cols AS NVARCHAR(MAX)
	,@colsSumar AS NVARCHAR(MAX)
	,@query  AS NVARCHAR(MAX)
	,@FECHAINI AS VARCHAR(8)
	,@FECHAFIN AS VARCHAR(8);
	
	SELECT @FECHAINI = REPLACE(CONVERT(VARCHAR(10), @FECHA_INICIAL, 121), '-', '') ;
	SELECT @FECHAFIN = REPLACE(CONVERT(VARCHAR(10), @FECHA_FINAL, 121), '-', '') ;
	
	WITH TX06 AS(
			
			SELECT   
				',' AS COMA
				,QUOTENAME(
					ISNULL(UPPER(left(DATENAME(MONTH,h_fecha),3))+CAST(datepart(year,h_fecha)AS VARCHAR(4)),'SIN_ALT')) AS ACRONIMO
				,(datepart(year,h_fecha)) AS YEARVIS
				,(datepart(MONTH,h_fecha)) AS MESVIS
			FROM tb_historial_mb
			WHERE CONVERT(date,h_fecha) between @FECHAINI AND @FECHAFIN
			GROUP BY DATENAME(MONTH,h_fecha),(datepart(year,h_fecha)),(datepart(MONTH,h_fecha))	
			--ORDER BY (datepart(year,h_fecha)),(datepart(MONTH,h_fecha))	
	)

	SELECT @cols = STUFF(
		(
			SELECT COMA,ACRONIMO 
				FROM TX06 
				ORDER BY YEARVIS, MESVIS
				FOR XML PATH (''), TYPE
		).value('.', 'NVARCHAR(MAX)')
		,1
		,1
		,'');
		
	WITH TX07 AS(
			
			SELECT   
				'+ ISNULL(' AS COMA
				,QUOTENAME(
					ISNULL(UPPER(left(DATENAME(MONTH,h_fecha),3))+CAST(datepart(year,h_fecha)AS VARCHAR(4)),'SIN_ALT'))+',0)' AS ACRONIMO
				,(datepart(year,h_fecha)) AS YEARVIS
				,(datepart(MONTH,h_fecha)) AS MESVIS
			FROM tb_historial_mb
			WHERE CONVERT(date,h_fecha) between @FECHAINI AND @FECHAFIN
			GROUP BY DATENAME(MONTH,h_fecha),(datepart(year,h_fecha)),(datepart(MONTH,h_fecha))	
			--ORDER BY (datepart(year,h_fecha)),(datepart(MONTH,h_fecha))	
	)
	
	SELECT @colsSumar = STUFF(
	(
		SELECT COMA,ACRONIMO
			FROM TX07 
			ORDER BY YEARVIS, MESVIS
			FOR XML PATH (''), TYPE
	).value('.', 'NVARCHAR(MAX)')
	,1
	,1
	,'');
	
	print @cols;
	
	select @query ='SELECT *,('+@colsSumar+') as ''TOTAL'' FROM (
			select distinct
					 d.cli_codigo_cliente  AS CLI_CODIGOCLIENTE
					,d.cli_identificacion AS CLI_IDENTIFICACION
					,d.cli_nombre_cliente AS CLI_NOMBRECLIENTE
					,d.dcli_provincia AS DCLI_PROVINCIA
					,d.dcli_canton as DCLI_CANTON
					,d.dcli_parroquia AS DCLI_PARROQUIA
					,d.dcli_calle_principal+'' ''+d.dcli_calle_secundaria+'' ''+d.dcli_nomenclatura AS DCLI_DIRECCION
					,d.dcli_telefono as DCLI_TELEFONO
					,a.h_usuario_nombre as H_USUARIONOMBRE
					,d.cli_estatus as CLI_ESTATUS
					--,d.cli_creado as CLI_CREADO
					,d.cli_creado_por as CLI_CREADOPOR 
					,UPPER(left(DATENAME(MONTH,a.h_fecha),3))+CAST(datepart(year,a.h_fecha)AS VARCHAR(4)) AS H_FECHAVISITA
					,COUNT(d.cli_codigo_cliente) as CLI_CONTEO
				FROM tb_historial_mb as a
					inner join V_INFORMACION_CLIENTE as d
						on a.h_cod_cliente=d.cli_codigo_cliente
				where 1=1
					and a.h_usuario='''+@EJECUTIVO + '''
					and convert(date,h_fecha) between '''+@FECHAINI + ''' AND  '''+@FECHAFIN + ''' 
					and h_accion=''Inicio visita''
		
				group by 
					UPPER(left(DATENAME(MONTH,a.h_fecha),3))+CAST(datepart(year,a.h_fecha)AS VARCHAR(4)) 
					, d.cli_codigo_cliente
					,d.cli_identificacion 
					,d.cli_nombre_cliente 
					,d.dcli_provincia 
					,d.dcli_canton 
					,d.dcli_parroquia 
					,d.dcli_calle_principal+'' ''+d.dcli_calle_secundaria+'' ''+d.dcli_nomenclatura 
					,d.dcli_telefono 
					,a.h_usuario_nombre
					,d.cli_estatus 
					--,d.cli_creado 
					,d.cli_creado_por
					
	   
				) A PIVOT
				(
					SUM(CLI_CONTEO) FOR H_FECHAVISITA IN ('+@cols +')
				) P  ;
				';
	print @query
	EXEC sp_executesql @query;
		
SET LANGUAGE us_english; 

END

GO


