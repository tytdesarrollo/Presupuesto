CREATE TRIGGER TRG_REPORTE3
ON ##TablaReporte2Final 
BEFORE UPDATE 
FOR EACH ROW
BEGIN

    DECLARE @ID_AFECTADO VARCHAR(15);
    @ID_AFECTADO = OLD.CODIGO;

    DECLARE @TOTALES_TEMP NVARCHAR(MAX);
    EXECUTE SP_NOMBRE_TOTALES
        N'##TablaReporte2', @OUT_CADENA = @TOTALES_TEMP OUTPUT;   
    ----------------------------------------------------------------------------
    DECLARE @RESULT NVARCHAR(MAX);
    DECLARE @SUMA  NVARCHAR(MAX);
    DECLARE @PARAMS NVARCHAR(MAX);
    
    SET @SUMA = 
            N'SELECT @RESULT = ISNULL(SUM('+@TOTALES_TEMP+'), 0)'+
            ' FROM TablaReporte2Final'+
            ' WHERE CODIGO = '+@ID_AFECTADO;

    SET @PARAMS = N'@RESULT NVARCHAR(MAX) OUTPUT';            
    ----------------------------------------------------------------------------    
    DECLARE @EXECUTE NVARCHAR(MAX)
    SET @EXECUTE = 
        N'UPDATE TablaReporte2Final '+
        'SET SALDO_EJEC = '+
        '(PRESU_DEFI) - ('+@TOTALES_TEMP+') '+
        ' WHERE CODIGO = '+@ID_AFECTADO;

    EXECUTE sp_executesql @EXECUTE;             
END;