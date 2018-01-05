USE [presama]
GO
/****** Object:  StoredProcedure [dbo].[SP_REPORTES_CONSOLIDADO_VIGNECIA]    Script Date: 11/12/2017 8:27:32 a.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_REPORTES_CONSOLIDADO_VIGNECIA]
(
	@IN_FECHA_INI DATE,
	@IN_FECHA_FIN DATE,
	@IN_MODALIDAD VARCHAR(30),
	@IN_FUERZA VARCHAR(100),
	@IN_VIGENCIA INT
)
AS
	SET NOCOUNT ON	

	DELETE FROM TablaCamposAut;

	----------------------------------------------------------------------------------------------
	DECLARE @SALDO_EJECUTAR NVARCHAR(MAX);
	DECLARE @PROYECCION NVARCHAR(MAX);
	DECLARE @NUMEROMESES NVARCHAR(10);	
	DECLARE @RED_ING VARCHAR(15) = 'RED_ING';
	DECLARE @PRE_ING VARCHAR(15) = 'PRE_ING';
	DECLARE @ADI_ING VARCHAR(15) = 'ADI_ING';
	DECLARE @AUT_PAG VARCHAR(15) = 'AUT_PAG';
	DECLARE @MENSAJEERROR VARCHAR(15) = 'Sin proyeccion';
	DECLARE @MENSAJEMES VARCHAR(13) = ' meses'

	----------------------------------------------------------------------------------------------
	-- EJECUTA EL PROCEDIMIENTO PARA EL LLENADO DE LA TABLA TablaReporte1
	EXEC SP_REPORTE2 @IN_CODIGO_OPN = 'AUT_PAG', 
					 @IN_FECHA_INI = @IN_FECHA_INI,
					 @IN_FECHA_FIN = @IN_FECHA_FIN,
					 @IN_MODALIDAD = @IN_MODALIDAD,
					 @IN_FUERZA = @IN_FUERZA;

	----------------------------------------------------------------------------------------------					 
	-- EJECUTA EL PROCEDIMIENTO PARA EL LLENADO DE LA TABLA TablaReporte1s
	EXEC SP_REPORTE2S @IN_CODIGO_OPN = 'AUT_PAG', 
					  @IN_FECHA_INI = @IN_FECHA_INI,
					  @IN_FECHA_FIN = @IN_FECHA_FIN,
					  @IN_MODALIDAD = @IN_MODALIDAD,
					  @IN_FUERZA = @IN_FUERZA;		

	----------------------------------------------------------------------------------------------
	-- NOMBRES DE LAS TABLAS ##TablaReporte1
	DECLARE @NOMBRES_TB2 NVARCHAR(MAX);
	DECLARE @CURSORDATA1 VARCHAR(15);

	DECLARE CURSOR1 CURSOR FOR 
		SELECT NAME
		FROM tempdb.sys.columns 
		WHERE OBJECT_ID = OBJECT_ID('tempdb..##TablaReporte1')
		ORDER BY COLUMN_ID

	OPEN CURSOR1
	FETCH NEXT FROM CURSOR1 INTO @CURSORDATA1
	FETCH NEXT FROM CURSOR1 INTO @CURSORDATA1
	WHILE @@FETCH_STATUS = 0
	BEGIN
		SET @NOMBRES_TB2 = CONCAT(@NOMBRES_TB2,@CURSORDATA1,' float DEFAULT 0,');

		FETCH NEXT FROM CURSOR1 INTO @CURSORDATA1
	END
	CLOSE CURSOR1
	DEALLOCATE CURSOR1		

	----------------------------------------------------------------------------------------------
	IF(ISNULL(OBJECT_ID('tempdb..##TablaReporte1'), 0) <> 0 AND ISNULL(OBJECT_ID('tempdb..##TablaReporte1s'), 0) <> 0)	
		BEGIN
			IF(ISNULL(OBJECT_ID('tempdb..##TablaReporte1Final'), 0) <> 0)	
				BEGIN
					DROP TABLE ##TablaReporte1Final;
				END
			--------------------------------------------------------------------------------------
			DECLARE @TABLA_FINAL NVARCHAR(MAX);
			SET @TABLA_FINAL = N'CREATE TABLE ##TablaReporte1Final('+
									'CODIGO varchar(15),'+
									'RUBRO varchar(200),'+
									'DESCRIPCION varchar(50),'+
									'PRESU_INI float DEFAULT 0,'+
									'ADICIONES float DEFAULT 0,'+
									'REDUCCION float DEFAULT 0,'+
									'PRESU_DEFI float DEFAULT 0,'+
									@NOMBRES_TB2+
									'SALDO_EJEC float DEFAULT 0,'+
									'PROYECCION float DEFAULT 0)';
			EXEC(@TABLA_FINAL);
			--------------------------------------------------------------------------------------
			-- NOMBRE DE LAS COLUMNAS DE LA TABLA TablaReporte1
			DECLARE @COLUMNS_TEMP1 NVARCHAR(MAX);
			DECLARE @NOMBRES_TEMP1 NVARCHAR(MAX);
			EXECUTE SP_NOMBRE_TABLAS
				N'##TablaReporte1', @OUT_CADENA = @COLUMNS_TEMP1 OUTPUT, @OUT_NOMBRE = @NOMBRES_TEMP1 OUTPUT;

			SET @NOMBRES_TEMP1 = REPLACE(@NOMBRES_TEMP1,'*_',',');
			SET @NOMBRES_TEMP1 = SUBSTRING(@NOMBRES_TEMP1,1,LEN(@NOMBRES_TEMP1)-1);			

			--------------------------------------------------------------------------------------
			DECLARE @DATACURSOR2 VARCHAR(15);
			DECLARE @DATACURSOR3 VARCHAR(200);
			DECLARE @DATACURSOR4 VARCHAR(50);
			DECLARE @DATACURSOR5 float;
			DECLARE @DATACURSOR6 float;
			DECLARE @DATACURSOR7 float;
			DECLARE @DATACURSOR8 float;
			
			DECLARE CURSOR2 CURSOR FOR
				SELECT AE.CODI_ESM AS CODIGO,
					AE.NOM_ESM AS RUBRO, 
					AM.NOMBRE_MODALIDAD AS DESCRIPCION, 
					ROUND(AE.MPRVAL,0) AS PRESU_INI,
					ISNULL((
						 SELECT SUM(E.MPRVAL) 
						 FROM AUDI_ESM_PRESUP E 
						 WHERE E.VIGENCIA=@IN_VIGENCIA 
						   AND E.OPNCOD=@ADI_ING 
						   AND E.CODI_ESM = AE.CODI_ESM),0) AS ADICIONES,
					ISNULL((
						 SELECT SUM(E.MPRVAL) 
						 FROM AUDI_ESM_PRESUP E 
						 WHERE E.VIGENCIA=@IN_VIGENCIA 
						   AND E.OPNCOD=@RED_ING 
						   AND E.CODI_ESM = AE.CODI_ESM),0) AS REDUCCION,
					ISNULL(
						 ISNULL((SELECT SUM(E.MPRVAL) 
						 FROM AUDI_ESM_PRESUP E 
						 WHERE E.VIGENCIA=@IN_VIGENCIA 
						   AND E.OPNCOD=@PRE_ING
						   AND E.CODI_ESM = AE.CODI_ESM),0)+
						 ISNULL((SELECT SUM(E.MPRVAL) 
						 FROM AUDI_ESM_PRESUP E 
						 WHERE E.VIGENCIA=@IN_VIGENCIA 
						   AND E.OPNCOD=@ADI_ING
						   AND E.CODI_ESM = AE.CODI_ESM),0)-
						 ISNULL((SELECT SUM(E.MPRVAL) 
						 FROM AUDI_ESM_PRESUP E 
						 WHERE E.VIGENCIA=@IN_VIGENCIA 
						   AND E.OPNCOD=@RED_ING
						   AND E.CODI_ESM = AE.CODI_ESM),0),ROUND(ae.MPRVAL,0)) AS PRESU_DEFI
				FROM AUDI_ESM_PRESUP AE, AUDI_MODALIDAD AM
				WHERE AE.MPRFEC BETWEEN @IN_FECHA_INI AND @IN_FECHA_FIN
					 AND AE.OPNCOD =@PRE_ING
					 AND AE.TX_MODALIDAD=@IN_MODALIDAD
					 AND AE.TX_FUERZA IN (@IN_FUERZA)
					 AND AE.TX_MODALIDAD = AM.CODIGO_MODALIDAD;

			OPEN CURSOR2
			FETCH NEXT FROM CURSOR2 INTO @DATACURSOR2,@DATACURSOR3,@DATACURSOR4,@DATACURSOR5,@DATACURSOR6,@DATACURSOR7,@DATACURSOR8;
			WHILE @@FETCH_STATUS = 0
			BEGIN
				--------------------------------------------------------------------------------------
				INSERT INTO ##TablaReporte1Final (
					CODIGO,
					RUBRO, DESCRIPCION, PRESU_INI,
					ADICIONES, REDUCCION, PRESU_DEFI)
				VALUES(
					@DATACURSOR2,
					@DATACURSOR3,@DATACURSOR4,@DATACURSOR5,
					@DATACURSOR6,@DATACURSOR7,@DATACURSOR8);
				--------------------------------------------------------------------------------------
				DECLARE @CURSORDATA9 VARCHAR(15);
				DECLARE @NSELECT NVARCHAR(MAX);

				DECLARE CURSOR3 CURSOR FOR
					SELECT NAME
					FROM tempdb.sys.columns 
					WHERE OBJECT_ID = OBJECT_ID('tempdb..##TablaReporte1')
					ORDER BY COLUMN_ID;

				OPEN CURSOR3
				FETCH NEXT FROM CURSOR3 INTO @CURSORDATA9 -- UNO MAS PARA NO TOMAR EL CODIGO 
				FETCH NEXT FROM CURSOR3 INTO @CURSORDATA9
				WHILE @@FETCH_STATUS = 0
				BEGIN				
					SET @NSELECT = CONCAT(@NSELECT,@CURSORDATA9,' = (SELECT ISNULL(',@CURSORDATA9,',0) FROM ##TablaReporte1 WHERE CODI_ESM = ',@DATACURSOR2,'),')
					FETCH NEXT FROM CURSOR3 INTO @CURSORDATA9
				END
				CLOSE CURSOR3
				DEALLOCATE CURSOR3

				SET @NSELECT = SUBSTRING(@NSELECT,1,LEN(@NSELECT)-1);		
				--------------------------------------------------------------------------------------
				DECLARE @QUERY NVARCHAR(MAX);
			 	DECLARE @PARAMS NVARCHAR(MAX);

				
				SET @QUERY =
						N''+
						'UPDATE ##TablaReporte1Final '+
						'SET '+
							@NSELECT+
						' WHERE CODIGO = '+@DATACURSOR2;				

				EXECUTE sp_executesql @QUERY;
				-------------------------------------------------------------------------------------
				
				--===========================================================================================
				--SATELITES
				--===========================================================================================
				DECLARE @DATACURSOR10 VARCHAR(15);
				DECLARE @DATACURSOR11 VARCHAR(200)

				DECLARE CURSOR4 CURSOR FOR					
					SELECT COD_SATELITE, NOMBRE_SATELITE
					FROM AUDI_SATELITE_PRESUP
					WHERE COD_ESM = @DATACURSOR2;

				OPEN CURSOR4
				FETCH NEXT FROM CURSOR4 INTO @DATACURSOR10, @DATACURSOR11
				WHILE @@FETCH_STATUS = 0
				BEGIN		
					--------------------------------------------------------------------------------------
					INSERT INTO ##TablaReporte1Final (
						CODIGO,	RUBRO)
					VALUES(
						@DATACURSOR10, @DATACURSOR11)
					--------------------------------------------------------------------------------------					
					DECLARE @CURSORDATA12 VARCHAR(15);
					DECLARE @NSELECT2 NVARCHAR(MAX);

					DECLARE CURSOR5 CURSOR FOR
						SELECT NAME
						FROM tempdb.sys.columns 
						WHERE OBJECT_ID = OBJECT_ID('tempdb..##TablaReporte1s')
						ORDER BY COLUMN_ID;

					OPEN CURSOR5
					FETCH NEXT FROM CURSOR5 INTO @CURSORDATA12 -- UNO MAS PARA NO TOMAR EL CODIGO 
					FETCH NEXT FROM CURSOR5 INTO @CURSORDATA12
					FETCH NEXT FROM CURSOR5 INTO @CURSORDATA12
					WHILE @@FETCH_STATUS = 0
					BEGIN				
						SET @NSELECT2 = CONCAT(@NSELECT2,@CURSORDATA12,' = (SELECT ',@CURSORDATA12,' FROM ##TablaReporte1s WHERE COD_SATELITE = ',@DATACURSOR10,'),')
						FETCH NEXT FROM CURSOR5 INTO @CURSORDATA12
					END
					CLOSE CURSOR5
					DEALLOCATE CURSOR5

					SET @NSELECT2 = SUBSTRING(@NSELECT2,1,LEN(@NSELECT2)-1);	
					--------------------------------------------------------------------------------------
					DECLARE @QUERY2 NVARCHAR(MAX);
				
					SET @QUERY2 =
							N''+
							'UPDATE ##TablaReporte1Final '+
							'SET '+
								@NSELECT2+
							' WHERE CODIGO = '+@DATACURSOR10;				

					EXECUTE sp_executesql @QUERY2;
					--------------------------------------------------------------------------------------
					SET @CURSORDATA12 = '';
					SET @NSELECT2 = '';

					FETCH NEXT FROM CURSOR4 INTO @DATACURSOR10, @DATACURSOR11
				END
				CLOSE CURSOR4
				DEALLOCATE CURSOR4				
				--===========================================================================================
				--SATELITES
				--===========================================================================================

				DECLARE @CURSORDATA13 VARCHAR(20);					
				DECLARE CURSOR6 CURSOR FOR
					SELECT Value
					FROM Split_reporte(@NOMBRES_TEMP1,',');

				OPEN CURSOR6
				FETCH NEXT FROM CURSOR6 INTO @CURSORDATA13
				WHILE @@FETCH_STATUS = 0
				BEGIN	
					--------------------------------------------------------------------------------------
					DECLARE @SUMAMES NVARCHAR(MAX);
					DECLARE @NSELECT3 NVARCHAR(MAX);
					DECLARE @PARAMS2 NVARCHAR(MAX);
					SET @NSELECT3 =
						N'SELECT @SUMAMES = isnull(SUM(suma), 0) '+
						'FROM '+
							'('+
									'SELECT '+
										'SUM('+@CURSORDATA13+') SUMA '+
									'FROM ##TablaReporte1Final '+
									'WHERE CODIGO IN (SELECT COD_SATELITE FROM AUDI_SATELITE_PRESUP WHERE COD_ESM = '+@DATACURSOR2+') '+
								'UNION ALL '+
									'SELECT '+
										'SUM('+@CURSORDATA13+') SUMA '+
									'FROM ##TablaReporte1Final '+
									'WHERE CODIGO IN ('+@DATACURSOR2+')'+
							')AS B';

					SET @PARAMS2 = N'@SUMAMES NVARCHAR(MAX) OUTPUT';	

					EXECUTE sp_executesql @NSELECT3,@PARAMS2, @SUMAMES = @SUMAMES OUTPUT;;
					--------------------------------------------------------------------------------------
					DECLARE @NUPDATE NVARCHAR(MAX);
					SET @NUPDATE = 
						N'UPDATE ##TablaReporte1Final '+
						'SET '+@CURSORDATA13+' = '+@SUMAMES+
						' WHERE CODIGO = '+@DATACURSOR2;									
					

					EXECUTE sp_executesql @NUPDATE;

					--------------------------------------------------------------------------------------					
					SET @NSELECT3 = '';
					SET @NUPDATE = '';								

					FETCH NEXT FROM CURSOR6 INTO @CURSORDATA13
				END
				CLOSE CURSOR6
				DEALLOCATE CURSOR6	
				--------------------------------------------------------------------------------------
				DECLARE @RESULTA1 NVARCHAR(MAX);
				DECLARE @RESULTA2 NVARCHAR(MAX);
				DECLARE @NSELECT4 NVARCHAR(MAX);	
				DECLARE @PARAMS3 NVARCHAR(MAX);				

				SET @NUMEROMESES = (select (len(@NOMBRES_TEMP1) - len(replace(REPLACE(@NOMBRES_TEMP1,',','+'), '+', ''))) / len('+')) + 1 ;
				
				SET @PROYECCION = CONCAT( 'CASE WHEN((', REPLACE(@NOMBRES_TEMP1,',','+'), ') = 0) THEN 0 ELSE ROUND((PRESU_DEFI - (', REPLACE(@NOMBRES_TEMP1,',','+'),'))/((', REPLACE(@NOMBRES_TEMP1,',','+'), ')/', @NUMEROMESES, '),0,1) END')
				
				SET @NSELECT4 = 
					N'SELECT @RESULTA1 = PRESU_DEFI - ISNULL(('+REPLACE(@NOMBRES_TEMP1,',','+')+'), 0),'+
					' 	@RESULTA2 = '+@PROYECCION+
					' FROM ##TablaReporte1Final'+
					' WHERE CODIGO = '+@DATACURSOR2;
					
				SET @PARAMS3 = N'@RESULTA1 NVARCHAR(MAX) OUTPUT, @RESULTA2 NVARCHAR(MAX) OUTPUT, @MENSAJEMES VARCHAR(13)';   

				EXECUTE sp_executesql @NSELECT4,@PARAMS3, @RESULTA1 = @RESULTA1 OUTPUT, @RESULTA2 = @RESULTA2 OUTPUT, @MENSAJEMES = @MENSAJEMES; 
				
				UPDATE ##TablaReporte1Final
				SET SALDO_EJEC = @RESULTA1,
					PROYECCION = @RESULTA2
				WHERE CODIGO = @DATACURSOR2;
				--------------------------------------------------------------------------------------
				SET @CURSORDATA9 = '';	
				SET @NSELECT = '';
				SET @NSELECT4 = '';

				FETCH NEXT FROM CURSOR2 INTO @DATACURSOR2,@DATACURSOR3,@DATACURSOR4,@DATACURSOR5,@DATACURSOR6,@DATACURSOR7,@DATACURSOR8;
			END
			CLOSE CURSOR2
			DEALLOCATE CURSOR2		
			--------------------------------------------------------------------------------------
			DECLARE @DATA VARCHAR(30);
			DECLARE @CONSULTAFINAL NVARCHAR(MAX);
			DECLARE @DATOSFINAL NVARCHAR(MAX);

			SET @NOMBRES_TEMP1 = REPLACE(@NOMBRES_TEMP1,',','*_');
			SET @NOMBRES_TEMP1 = CONCAT('RUBRO*_DESCRIPCION*_PRESU_INI*_ADICIONES*_REDUCCION*_PRESU_DEFI*_', @NOMBRES_TEMP1, '*_SALDO_EJEC*_PROYECCION');

			DECLARE CURSORFINA CURSOR FOR
				SELECT NAME
				FROM tempdb.sys.columns 
				WHERE OBJECT_ID = OBJECT_ID('tempdb..##TablaReporte1Final')
					AND NAME NOT IN ('CODIGO')
				ORDER BY COLUMN_ID;

			OPEN CURSORFINA
			FETCH NEXT FROM CURSORFINA INTO @DATA
			WHILE @@FETCH_STATUS = 0
			BEGIN	
				IF(@DATA = 'PROYECCION')
					BEGIN
						SET @CONSULTAFINAL = CONCAT(@CONSULTAFINAL,'CASE ISNULL(',@DATA,',0) WHEN 0 THEN @MENSAJEERROR ELSE ',' CONCAT(',@DATA,', ', '@MENSAJEMES) END AS ',@DATA)
					END
				ELSE
					BEGIN
						SET @CONSULTAFINAL = CONCAT(@CONSULTAFINAL,'ISNULL(',@DATA,',0) AS ',@DATA,', ')
					END		
				FETCH NEXT FROM CURSORFINA INTO @DATA	
			END
			CLOSE CURSORFINA
			DEALLOCATE CURSORFINA

			SET @CONSULTAFINAL = CONCAT('SELECT @NOMBRES_TEMP1 AS NOMBRES_COLUMNAS,',@CONSULTAFINAL,' FROM ##TablaReporte1Final')
			
			SET @DATOSFINAL =
				N'@MENSAJEERROR VARCHAR(15),'+
				'@MENSAJEMES VARCHAR(13),'+
				'@NOMBRES_TEMP1 NVARCHAR(MAX)';
			
			EXECUTE sp_executesql @CONSULTAFINAL, @DATOSFINAL, @MENSAJEERROR = @MENSAJEERROR, @MENSAJEMES = @MENSAJEMES, @NOMBRES_TEMP1 = @NOMBRES_TEMP1;

			
		END

	ELSE
		BEGIN
			SELECT * FROM AUDI_ESM_PRESUP WHERE CODI_ESM = 'DATOSVACIOSSIEMPRE'
		END