--------------------------------------------------------
--  File created - Saturday-December-03-2016   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Table YEAR
--------------------------------------------------------

  CREATE TABLE "ABHINAV21793"."YEAR" 
   (	"YEAR" NUMBER(6,0), 
	"HOST_COUNTRY" VARCHAR2(128 BYTE), 
	"HOST_CITY" VARCHAR2(128 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  Constraints for Table YEAR
--------------------------------------------------------

  ALTER TABLE "ABHINAV21793"."YEAR" MODIFY ("HOST_CITY" NOT NULL ENABLE);
  ALTER TABLE "ABHINAV21793"."YEAR" MODIFY ("HOST_COUNTRY" NOT NULL ENABLE);
  ALTER TABLE "ABHINAV21793"."YEAR" MODIFY ("YEAR" NOT NULL ENABLE);
