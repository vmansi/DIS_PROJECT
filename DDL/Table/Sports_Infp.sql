--------------------------------------------------------
--  File created - Saturday-December-03-2016   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Table SPORTS_INFO
--------------------------------------------------------

  CREATE TABLE "ABHINAV21793"."SPORTS_INFO" 
   (	"SPORT" VARCHAR2(128 BYTE), 
	"DISCIPLINE" VARCHAR2(128 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  Constraints for Table SPORTS_INFO
--------------------------------------------------------

  ALTER TABLE "ABHINAV21793"."SPORTS_INFO" MODIFY ("DISCIPLINE" NOT NULL ENABLE);
  ALTER TABLE "ABHINAV21793"."SPORTS_INFO" MODIFY ("SPORT" NOT NULL ENABLE);
