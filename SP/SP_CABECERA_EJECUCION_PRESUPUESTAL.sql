USE [presama]
GO
/****** Object:  StoredProcedure [dbo].[SP_CABECERA_EJECUCION_PRESUPUESTAL]    Script Date: 12/10/2017 16:17:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[SP_CABECERA_EJECUCION_PRESUPUESTAL]
AS
	SELECT  EMPCOD, '900.806.124-1' NIT
	FROM AUDI_ESM_PRESUP
	WHERE NU_AUTO_ESM = '1';	