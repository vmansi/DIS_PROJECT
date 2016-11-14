import pandas as pd
import numpy as np

fp1 = 'Athlete.xlsx'
fp2 = 'Won_Temp.xlsx'

df1 = pd.read_excel(fp1) 
df2 = pd.read_excel(fp2)

d1 = {}
for i, r in df1.iterrows():
	k = tuple([r.Sport, r.A_Fname, r.A_Lname, r.Gender, r.Country_Code])
	temp = d1.get(k)
	if not temp:
		d1[k] = r.Aid


df2['Aid'] = '0'

for i, r in df2.iterrows():
	k = tuple([r.Sport, r.A_Fname, r.A_Lname, r.Gender, r.Country_Code])
	temp = d1.get(k)
	df2.loc[i, 'Aid'] = temp


writer = pd.ExcelWriter('Won.xlsx', engine='xlsxwriter')
df2.to_excel(writer, sheet_name='Sheet1')
writer.save()