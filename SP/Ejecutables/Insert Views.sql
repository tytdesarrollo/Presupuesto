EXEC SP_INSERT_ADICION
@IN_NUM_DOCU ='5482,5482,5482',
@IN_FEC_MOV = '2015-03-23,2015-03-23,2015-03-23', 
@IN_FEC_AUT = '2015-03-20,2015-03-20,2015-03-20',
@IN_COD_FUERZA = '60000,60000,60000',
@IN_MODA = 'DISP,DISP,DISP',
@IN_VIG = '2015,2015,2015',
@IN_COD_ESM = '2414,5101,1048',
@IN_VAL_AUTO = '8536000,12156000,10562000'

-----------------------------------------------------------------------------------------------------

EXEC SP_INSERT_REDUCCION
@IN_NUM_DOCU ='6048,6048',
@IN_FEC_MOV = '2015-05-10,2015-05-10', 
@IN_FEC_AUT = '2015-05-05,2015-05-05',
@IN_COD_FUERZA = '60000,60000,60000',
@IN_MODA = 'DISP,DISP,DISP',
@IN_VIG = '2015,2015,2015',
@IN_COD_ESM = '2414,5101',
@IN_VAL_AUTO = '13039000,9127000'

-----------------------------------------------------------------------------------------------------

EXEC SP_INSERT_AUTPAGOS
@IN_NUM_DOCU ='5482,5482,5482',
@IN_FEC_MOV = '2015-04-28,2015-04-28,2015-04-28', 
@IN_FEC_AUT = '2015-04-25,2015-04-25,2015-04-25',
@IN_COD_FUERZA = '60000,60000,60000',
@IN_MODA = 'DISP,DISP,DISP',
@IN_VIG = '2015,2015,2015',
@IN_COD_ESM = '3022,3056,1048',
@IN_VAL_AUTO = '12536000,32156000,24562000',
@IN_AMORTI= '345000, 268000, 456980',
@IN_MES_FACT = '4,4,4'