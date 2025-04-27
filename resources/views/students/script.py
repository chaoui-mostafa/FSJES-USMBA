import sys
import pandas as pd
import mysql.connector
from datetime import datetime

# الحصول على مسار الملف المرسل من PHP
file_path = sys.argv[1]

# قراءة ملف الإكسيل
df = pd.read_excel(file_path)

# 2. تصحيح التاريخ Excel (لو كان بالصيغة الغلط)
def fix_date(excel_date):
    if pd.isna(excel_date):
        return None
    if isinstance(excel_date, (int, float)):
        return (datetime(1899, 12, 30) + pd.to_timedelta(excel_date, unit='D')).date()
    if isinstance(excel_date, datetime):
        return excel_date.date()
    return None

if 'DATE_NAISSANCE' in df.columns:
    df['DATE_NAISSANCE'] = df['DATE_NAISSANCE'].apply(fix_date)

# 3. ربط مع قاعدة بيانات MySQL
conn = mysql.connector.connect(
    host='localhost',
    user='root',
    password='chawi2003',
    database='usmba'
)

cursor = conn.cursor()

# 4. إدخال البيانات وحدة بوحدة
for index, row in df.iterrows():
    sql = """
    INSERT INTO students (NUMERO, CNE, CIN, NOM, PRENOM, DATE_NAISSANCE, NATIONALITE, EMAIL, TELEPHONE, SPECIALITE, SUJET, ENCADREUR_1, ENCADREUR_2, PRESIDENT, RAPPORTEUR_INT, RAPPORTEUR_EXT)
    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
    """
    values = (
        row.get('NUMERO'),
        row.get('CNE'),
        row.get('CIN'),
        row.get('NOM'),
        row.get('PRENOM'),
        row.get('DATE_NAISSANCE'),
        row.get('NATIONALITE'),
        row.get('EMAIL'),
        row.get('TELEPHONE'),
        row.get('SPECIALITE'),
        row.get('SUJET'),
        row.get('ENCADREUR_1'),
        row.get('ENCADREUR_2'),
        row.get('PRESIDENT'),
        row.get('RAPPORTEUR_INT'),
        row.get('RAPPORTEUR_EXT')
    )
    cursor.execute(sql, values)

# 5. كمل العملية
conn.commit()
cursor.close()
conn.close()

print("✅ تم رفع البيانات بنجاح!")
