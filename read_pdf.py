import PyPDF2
reader = PyPDF2.PdfReader("Müfredat Materyal Havuzu Projesi A'dan Z'ye Geliştirme Dokümanı.pdf")
text = ""
for page in reader.pages:
    text += page.extract_text() + "\n"
print(text)
