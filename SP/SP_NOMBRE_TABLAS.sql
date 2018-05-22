USE [presama]
GO
/****** Object:  StoredProcedure [dbo].[SP_NOMBRE_TABLAS]    Script Date: 12/10/2017 16:33:15 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[SP_NOMBRE_TABLAS]
(
	@IN_NOMBRE_TABLA VARCHAR(40),
	@OUT_CADENA NVARCHAR(MAX) OUTPUT,
	@OUT_NOMBRE NVARCHAR(MAX) OUTPUT
)
AS
	--
	DECLARE @COLUMNAS NVARCHAR(MAX) = '';
	DECLARE @NOMBRES NVARCHAR(MAX) = '';
	-- VARIABLES QUE RECIBEN DATOS DEL CURSOR
	DECLARE @CURSORDATA1 VARCHAR(15);

	-- CURSOR
	DECLARE CURSOR1 CURSOR FOR
		SELECT NAME
		FROM tempdb.sys.columns 
		WHERE OBJECT_ID = OBJECT_ID('tempdb..'+@IN_NOMBRE_TABLA)
		ORDER BY COLUMN_ID

	OPEN CURSOR1
	FETCH NEXT FROM CURSOR1 INTO @CURSORDATA1 -- UNO MAS PARA NO TOMAR EL CODIGO 
	FETCH NEXT FROM CURSOR1 INTO @CURSORDATA1
	
	IF((SUBSTRING(@IN_NOMBRE_TABLA,LEN(@IN_NOMBRE_TABLA),LEN(@IN_NOMBRE_TABLA))) LIKE 'S')
		BEGIN
			FETCH NEXT FROM CURSOR1 INTO @CURSORDATA1
		END

	WHILE @@FETCH_STATUS = 0
	BEGIN
		SET @COLUMNAS = CONCAT(@COLUMNAS, 'ISNULL((SELECT ', @CURSORDATA1, ' FROM ', @IN_NOMBRE_TABLA, ' TR WHERE TR.CODI_ESM = AE.CODI_ESM),0) AS ', @CURSORDATA1, ',');
		SET @NOMBRES = CONCAT(@NOMBRES, @CURSORDATA1, '*_')

		FETCH NEXT FROM CURSOR1 INTO @CURSORDATA1
	END
	CLOSE CURSOR1
	DEALLOCATE CURSOR1

	SET @COLUMNAS = SUBSTRING(@COLUMNAS,1,LEN(@COLUMNAS)-1);
	SET @COLUMNAS = CONCAT(@COLUMNAS, ' ');

	SET @OUT_CADENA = @COLUMNAS;
	SET @OUT_NOMBRE = @NOMBRES;

	
