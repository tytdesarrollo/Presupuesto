USE [presama]
GO
/****** Object:  StoredProcedure [dbo].[pruebapivotdinamic]    Script Date: 12/10/2017 16:17:06 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[pruebapivotdinamic] (@codigo NVARCHAR(10),@fecha1 DATE,@fecha2 DATE)
AS
	DECLARE @TSQL NVARCHAR(MAX),
			@Params NVARCHAR(MAX),
			@extra NVARCHAR(MAX) = 'FOR [MES] in ([1],[2],[3],[4],[5])';

	SET @TSQL = N'
					SELECT *
					FROM (
						SELECT  month(MPRFEC) MES, MPRVAL, CODI_ESM
						FROM AUDI_ESM_PRESUP
						WHERE  MPRFEC between @fecha1 and @fecha2
						and OPNCOD = @codigo
					) A
					PIVOT(
						MAX(MPRVAL)'+@extra+'						
					) P';
	SET @Params = N'@codigo NVARCHAR(10),
					@fecha1 DATE,
					@fecha2 DATE';
	EXECUTE sp_executesql @TSQL, @Params, @codigo = @codigo, @fecha1 = @fecha1, @fecha2 = @fecha2;
