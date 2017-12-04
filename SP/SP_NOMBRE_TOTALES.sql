USE [presama]
GO
/****** Object:  StoredProcedure [dbo].[SP_NOMBRE_TOTALES]    Script Date: 12/10/2017 16:45:51 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[SP_NOMBRE_TOTALES]
(
	@IN_NOMBRE_TABLA VARCHAR(40),
	@OUT_CADENA NVARCHAR(MAX) OUTPUT	
)
AS
	--
	DECLARE @COLUMNAS NVARCHAR(MAX) = '';
	DECLARE @NUMERO INT;
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
	WHILE @@FETCH_STATUS = 0
	BEGIN
		--
		SET @NUMERO = CAST((SELECT SUBSTRING(@CURSORDATA1,len(@CURSORDATA1),1)) AS INT)

		IF( @NUMERO = 3 )
			BEGIN
				SET @COLUMNAS = CONCAT(@COLUMNAS, @CURSORDATA1,'+'); 
			END
		

		FETCH NEXT FROM CURSOR1 INTO @CURSORDATA1
	END
	CLOSE CURSOR1
	DEALLOCATE CURSOR1

	SET @COLUMNAS = SUBSTRING(@COLUMNAS,1,LEN(@COLUMNAS)-1);
	SET @COLUMNAS = CONCAT(@COLUMNAS, ' ');

	SET @OUT_CADENA = @COLUMNAS;
	
