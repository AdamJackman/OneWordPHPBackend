 CREATE TABLE saltstore(
 userid INTEGER NOT NULL,
 site varchar(64) NOT NULL,
 salt varchar(64) NOT NULL,
 len INTEGER NOT NULL,
 reqSym boolean NOT NULL,
 reqNum boolean NOT NULL,
 PRIMARY KEY(userid, site, salt)
 );

 
  CREATE TABLE users(
 userid SERIAL PRIMARY KEY,
 Varchar(24) username NOT NULL
 );