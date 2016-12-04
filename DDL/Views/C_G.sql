--------------------------------------------------------
--  File created - Saturday-December-03-2016   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for View C_G
--------------------------------------------------------

  CREATE OR REPLACE FORCE VIEW "ABHINAV21793"."C_G" ("COUNTRY_CODE", "YEAR", "CNT") AS 
  SELECT  M1.Country_Code, M1.Year, COUNT(*)
FROM Medals1_Temp  M1
WHERE M1.Medal = 'Gold'
GROUP BY M1.Country_Code, M1.Year;
