CREATE TABLE saltstore(
	userid INTEGER REFERENCES users(userid),
	site varchar(64) NOT NULL,
	salt varchar(64) NOT NULL,
 	len INTEGER NOT NULL,
 	reqSym boolean NOT NULL,
 	reqNum boolean NOT NULL,
 	PRIMARY KEY(userid, site, salt)
);

 
CREATE TABLE users(
	userid SERIAL PRIMARY KEY,
	username VARCHAR(24) NOT NULL 
);


CREATE TABLE randomstore(
	userid INTEGER REFERENCES users(userid),
	site varchar(64) NOT NULL,
	ranSym VARCHAR(1),
	ranNum INTEGER,
	ranSymPos INTEGER,
	ranNumPos INTEGER,
	PRIMARY KEY(userid, site)
);