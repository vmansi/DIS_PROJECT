CREATE VIEW v1_ques3(Aid, FName, LName, Discipline, cnt):
	AS
	SELECT A.Aid as Aid, A.FName as FName, A.LName as LName, W.Discipline as Discipline, COUNT(*) as cnt
	FROM Athlete A INNER JOIN Won W ON A.Aid = W.Aid
	WHERE W.Medal = "Gold" 
	GROUP BY A.Aid, A.FName, A.LName, W.Discipline


CREATE VIEW ques3(Aid, FName, LName, Sport)
	AS 
	WITH temp2 AS(
	SELECT  T.Discipline as Discipline, MAX(T.cnt) as mcnt
	FROM v1_ques3 T
	GROUP BY T.Discipline)
	SELECT T1.Aid, T1.FName, T1.LName, T1.Discipline
	FROM v1_ques3 T1 INNER JOIN temp2 T2 ON T1.Discipline = T2.Discipline
	WHERE T1.cnt = T2.mcnt



CREATE VIEW v1_ques4(Aid, FName, LName, Discipline, cnt):
	AS
	SELECT A.Aid as Aid, A.FName as FName, A.LName as LName, W.Discipline as Discipline, COUNT(*) as cnt
	FROM Athlete A INNER JOIN Won W ON A.Aid = W.Aid
	GROUP BY A.Aid, A.FName, A.LName, W.Discipline


CREATE VIEW ques4(Aid, FName, LName, Sport)
	AS 
	WITH temp2 AS(
	SELECT  T.Discipline as Discipline, MAX(T.cnt) as mcnt
	FROM v1_ques4 T
	GROUP BY T.Discipline)
	SELECT T1.Aid, T1.FName, T1.LName, T1.Discipline
	FROM v1_ques4 T1 INNER JOIN temp2 T2 ON T1.Discipline = T2.Discipline
	WHERE T1.cnt = T2.mcnt




CREATE VIEW v1_ques5(Country_Code, Discipline, Year, Name, cnt):
	AS
	SELECT A.Country_Code as Country_Code, W.Discipline as Discipline, W.Year as Year, C.Name as Name,COUNT(*) as cnt
	FROM Athlete A INNER JOIN Won W ON A.Aid = W.Aid INNER JOIN Countries C ON A.Country_Code = C.Country_Code
	GROUP BY A.Country_Code, W.Discipline, W.Year, C.Name


CREATE VIEW ques5(Sport, Country, Year)
	AS 
	WITH temp2 AS(
	SELECT  T.Discipline as Discipline, T.Year as Year, MAX(T.cnt) as mcnt
	FROM v1_ques5 T
	GROUP BY T.Discipline, T.Year)
	SELECT  T1.Discipline, T1.Name, T1.Year
	FROM v1_ques5 T1 INNER JOIN temp2 T2 ON T1.Discipline = T2.Discipline AND T1.Year = T2.Year
	WHERE T1.cnt = T2.mcnt



CREATE VIEW C_G(Country_Code, Year, Cnt)
	AS
	SELECT  M1.Country_Code, M1.Year, COUNT(*)
	FROM Medals_1_Temp as M1
	WHERE M1.Medal = "Gold"
	GROUP BY M1.Country_Code, M1.Year

CREATE VIEW C_S(Country_Code, Year, Cnt)
	AS
	SELECT  M1.Country_Code, M1.Year, COUNT(*)
	FROM Medals_1_Temp as M1
	WHERE M1.Medal = "Silver"
	GROUP BY M1.Country_Code, M1.Year

CREATE VIEW C_B(Country_Code, Year, Cnt)
	AS
	SELECT  M1.Country_Code, M1.Year, COUNT(*)
	FROM Medals_1_Temp as M1
	WHERE M1.Medal = "Bronze"
	GROUP BY M1.Country_Code, M1.Year

CREATE VIEW C_T(Country_Code, Year, Cnt)
	AS
	SELECT  M1.Country_Code, M1.Year, COUNT(*)
	FROM Medals_1_Temp as M1
	GROUP BY M1.Country_Code, M1.Year

CREATE VIEW COUNTRY_SCORE(Country_Code, Year, Num_Gold, Num_Silver, Num_Bronze, Num_Total)
	AS 
	SELECT  C_G.Country_Code, C_G.Year, C_G.Cnt, C_S.Cnt, C_B.Cnt, C_T.Cnt 
	FROM C_G, C_S, C_B, C_T
	WHERE C_G.Country_Code = C_S.Country_Code AND C_G.Year = C_S.Year AND C_S.Country_Code = C_B.Country_Code AND C_S.Year = C_B.Year AND C_B.Country_Code = C_T.Country_Code AND C_B.Year = C_T.Year 


CREATE VIEW ques6(Year, Country)
	AS 
	WITH temp2 AS(
	SELECT  C.Year as Year, MAX(C.Num_Gold) as MaxGold 
	FROM COUNTRY_SCORE C
	GROUP BY C.Year)
	SELECT  T.Year, C.Name
	FROM Countries C INNER JOIN COUNTRY_SCORE CS On C.Country_Code = CS.Country_Code INNER JOIN temp2 T ON CS.Year = T.Year
	WHERE CS.Num_Gold = T.MaxGold


CREATE VIEW ques7(Year, Country)
	AS 
	WITH temp2 AS(
	SELECT  C.Year as Year, MAX(C.Num_Total) as MaxTotal 
	FROM COUNTRY_SCORE C
	GROUP BY C.Year)
	SELECT  T.Year, C.Name
	FROM Countries C INNER JOIN COUNTRY_SCORE CS On C.Country_Code = CS.Country_Code INNER JOIN temp2 T ON CS.Year = T.Year
	WHERE CS.Num_Total = T.MaxTotal

