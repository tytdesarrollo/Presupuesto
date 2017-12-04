USE [presama]
GO
/****** Object:  StoredProcedure [dbo].[SP_INSERT_REDUCCION]    Script Date: 12/10/2017 16:29:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[SP_INSERT_REDUCCION] 
(
	@IN_NUM_DOCU		varchar(max),
	@IN_FEC_MOV 		varchar(max),
	@IN_FEC_AUT 		varchar(max),
	@IN_COD_FUERZA 		varchar(max),
	@IN_MODA 			varchar(max),
	@IN_VIG 			varchar(max),
	@IN_COD_ESM 		varchar(max),
	@IN_VAL_AUTO 		varchar(max)
)
AS
	SET NOCOUNT ON
	--El separador de nuestros T_PAGOS sera una ,
	DECLARE @Posicion int
	DECLARE @Posicion2 int
	DECLARE @Posicion3 int
	DECLARE @Posicion4 int
	DECLARE @Posicion5 int
	DECLARE @Posicion6 int
	DECLARE @Posicion7 int
	DECLARE @Posicion8 int

	--@Posicion es la posicion de cada uno de nuestros separadores
	DECLARE @NUM_DOCU varchar(200)
	DECLARE @FEC_MOV varchar(200)
	DECLARE @FEC_AUT varchar(200)
	DECLARE @COD_FUERZA varchar(200)
	DECLARE @MODA varchar(200)
	DECLARE @VIG varchar(200)
	DECLARE @COD_ESM varchar(200)
	DECLARE @VAL_AUTO varchar(200)
	
	----------------------------------------------
	DECLARE @V_NOM_ESM varchar(200)
	DECLARE @V_MPRMOVLIN int
	
	--@Parametro es cada uno de los valores obtenidos
	--que almacenaremos en #T_PAGOS
	SET @IN_NUM_DOCU = @IN_NUM_DOCU + ','
	SET @IN_FEC_MOV = @IN_FEC_MOV + ','
	SET @IN_FEC_AUT = @IN_FEC_AUT + ','
	SET @IN_COD_FUERZA = @IN_COD_FUERZA + ','
	SET @IN_MODA = @IN_MODA + ','
	SET @IN_VIG = @IN_VIG + ','	
	SET @IN_COD_ESM  = @IN_COD_ESM + ','
	SET @IN_VAL_AUTO = @IN_VAL_AUTO + ','
	
	--Colocamos un separador al final de los T_PAGOS
	--para que funcione bien nuestro codigo
	--Hacemos un bucle que se repite mientras haya separadores
	
	SET @V_MPRMOVLIN = 1 --INICIALIZO LA VARIABLE EN 1 PARA CONTROLAR EL INCREMENTO
	
	WHILE patindex('%,%' , @IN_NUM_DOCU) <> 0
		BEGIN
			--patindex busca un patron en una cadena y nos devuelve su posicion		
			SELECT @Posicion =  patindex('%,%' , @IN_NUM_DOCU)
			SELECT @Posicion2 =  patindex('%,%' , @IN_FEC_MOV)
			SELECT @Posicion3 =  patindex('%,%' , @IN_FEC_AUT)
			SELECT @Posicion4 =  patindex('%,%' , @IN_COD_FUERZA)
			SELECT @Posicion5 =  patindex('%,%' , @IN_MODA)
			SELECT @Posicion6 =  patindex('%,%' , @IN_VIG)			
			SELECT @Posicion7 =  patindex('%,%' , @IN_COD_ESM)
			SELECT @Posicion8 =  patindex('%,%' , @IN_VAL_AUTO)		
	
			
			--Buscamos la posicion de la primera ,
			SELECT @NUM_DOCU = left(@IN_NUM_DOCU, @Posicion - 1)
			SELECT @FEC_MOV = left(@IN_FEC_MOV, @Posicion2 - 1)
			SELECT @FEC_AUT = left(@IN_FEC_AUT, @Posicion3 - 1)
			SELECT @COD_FUERZA = left(@IN_COD_FUERZA, @Posicion4 - 1)
			SELECT @MODA = left(@IN_MODA, @Posicion5 - 1)
			SELECT @VIG = left(@IN_VIG, @Posicion6 - 1)			
			SELECT @COD_ESM = left(@IN_COD_ESM, @Posicion7 - 1)
			SELECT @VAL_AUTO = left(@IN_VAL_AUTO, @Posicion8 - 1)
			
			
			--BUSCO EL NOMBRE DEL ESM
			SET @V_NOM_ESM= (SELECT DISTINCT(A.NOM_ESM)
							FROM AUDI_ESM_PRESUP A
							WHERE A.CODI_ESM = @COD_ESM
							AND A.TX_FUERZA= @COD_FUERZA
							AND A.TX_MODALIDAD = @MODA);						
						
			INSERT INTO AUDI_ESM_PRESUP 
			(TX_MODALIDAD,TX_FUERZA,EMPCOD,OPNCOD,VIGENCIA,MPRFEC,MPRDOCN,MPRMOVLIN,CODI_ESM,
			NOM_ESM,TX_CODI_MUNI,TX_CODI_DPTO,MPRVAL,ESTADO, AMORTIZACION,MES_FACTURA, FEC_AUTORI) 
			VALUES 
			(@MODA,@COD_FUERZA,'CONSORCIO SAMA','RED_ING',@VIG,@FEC_MOV,@NUM_DOCU,@V_MPRMOVLIN,@COD_ESM,
			@V_NOM_ESM,'','',@VAL_AUTO,'1','','',@FEC_AUT) 			

			--Reemplazamos lo procesado con nada con la funcion stuff
			SELECT @IN_NUM_DOCU = stuff(@IN_NUM_DOCU, 1, @Posicion, '')
			SELECT @IN_FEC_MOV = stuff(@IN_FEC_MOV, 1, @Posicion2, '')
			SELECT @IN_FEC_AUT = stuff(@IN_FEC_AUT, 1, @Posicion3, '')
			SELECT @IN_COD_FUERZA = stuff(@IN_COD_FUERZA, 1, @Posicion4, '')
			SELECT @IN_MODA = stuff(@IN_MODA, 1, @Posicion5, '')
			SELECT @IN_VIG = stuff(@IN_VIG, 1, @Posicion6, '')
			SELECT @IN_COD_ESM = stuff(@IN_COD_ESM, 1, @Posicion7, '')
			SELECT @IN_VAL_AUTO = stuff(@IN_VAL_AUTO, 1, @Posicion8, '')
			
			
			SET @V_MPRMOVLIN = @V_MPRMOVLIN + 1
		END
	--Y cuando se han recorrido todos los T_PAGOS sacamos por pantalla el resultado
	SELECT * 
	FROM AUDI_ESM_PRESUP
	SET NOCOUNT OFF
