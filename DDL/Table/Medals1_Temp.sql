--------------------------------------------------------
--  File created - Saturday-December-03-2016   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Table MEDALS1_TEMP
--------------------------------------------------------

  CREATE TABLE "ABHINAV21793"."MEDALS1_TEMP" 
   (	"YEAR" NUMBER(6,0), 
	"SPORT" VARCHAR2(128 BYTE), 
	"COUNTRY_CODE" VARCHAR2(26 BYTE), 
	"MEDAL" VARCHAR2(26 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  Constraints for Table MEDALS1_TEMP
--------------------------------------------------------

  ALTER TABLE "ABHINAV21793"."MEDALS1_TEMP" MODIFY ("MEDAL" NOT NULL ENABLE);
  ALTER TABLE "ABHINAV21793"."MEDALS1_TEMP" MODIFY ("COUNTRY_CODE" NOT NULL ENABLE);
  ALTER TABLE "ABHINAV21793"."MEDALS1_TEMP" MODIFY ("SPORT" NOT NULL ENABLE);
  ALTER TABLE "ABHINAV21793"."MEDALS1_TEMP" MODIFY ("YEAR" NOT NULL ENABLE);
