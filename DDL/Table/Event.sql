--------------------------------------------------------
--  File created - Saturday-December-03-2016   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Table EVENT
--------------------------------------------------------

  CREATE TABLE "ABHINAV21793"."EVENT" 
   (	"DISCIPLINE" VARCHAR2(128 BYTE), 
	"EVENT_NAME" VARCHAR2(128 BYTE), 
	"EVENT_GENDER" VARCHAR2(2 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  Constraints for Table EVENT
--------------------------------------------------------

  ALTER TABLE "ABHINAV21793"."EVENT" MODIFY ("EVENT_GENDER" NOT NULL ENABLE);
  ALTER TABLE "ABHINAV21793"."EVENT" MODIFY ("EVENT_NAME" NOT NULL ENABLE);
  ALTER TABLE "ABHINAV21793"."EVENT" MODIFY ("DISCIPLINE" NOT NULL ENABLE);
