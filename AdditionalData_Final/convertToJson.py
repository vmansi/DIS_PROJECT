import xlrd
from collections import OrderedDict
import simplejson as json

# Open the workbook and select the first worksheet
wb = xlrd.open_workbook('ImageQuestions.xlsx')
sh = wb.sheet_by_index(0)

# List to hold dictionaries
data_list = []

# Iterate through each row in worksheet and fetch values into dict
# for rownum in range(1, sh.nrows):
# 	data = {}
# 	row_values = sh.row_values(rownum)
# 	data['Question'] = row_values[0]
# 	data['Options'] = []
# 	for i in range(4):
# 		if row_values[i+1]:
# 			data['Options'].append(row_values[i+1])
# 	data['Answers']	= row_values[5]
# 	if row_values[6]:
# 		data['Notes'] = row_values[6]

# 	data_list.append(data)


# for rownum in range(1, sh.nrows):
# 	data = {}
# 	row_values = sh.row_values(rownum)
# 	data['Fact'] = row_values[0]

# 	data_list.append(data)


for rownum in range(1, sh.nrows):
	data = {}
	row_values = sh.row_values(rownum)
	data['URL'] = row_values[0]
	data['Options'] = []
	for i in range(4):
		if row_values[i+1]:
			data['Options'].append(row_values[i+1])
	data['Answers']	= row_values[5]
	if row_values[6]:
		data['Notes'] = row_values[6]
	data['Mascot']	= row_values[7]

	data_list.append(data)

print data_list
# Serialize the list of dicts to JSON
j = json.dumps(data_list)

# Write to file
with open('ImageQuestions.json', 'w') as f:
	f.write(j)