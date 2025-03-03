import mysql.connector

# Connexion à la base de données MySQL
def get_db_connection():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="root",
        database="rxProjetDb",
        port=8889
    )

# CRUD pour Employee
def get_employee(employee_id: int):
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT * FROM employees WHERE id = %s", (employee_id,))
    employee = cursor.fetchone()
    conn.close()
    return employee

def get_employees(skip: int = 0, limit: int = 100):
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT * FROM employees LIMIT %s OFFSET %s", (limit, skip))
    employees = cursor.fetchall()
    conn.close()
    return employees

def create_employee(nom: str, poste: str):
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("INSERT INTO employees (nom, poste) VALUES (%s, %s)", (nom, poste))
    conn.commit()
    employee_id = cursor.lastrowid
    conn.close()
    return {"id": employee_id, "nom": nom, "poste": poste}

def update_employee(employee_id: int, nom: str, poste: str):
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("UPDATE employees SET nom = %s, poste = %s WHERE id = %s", (nom, poste, employee_id,))
    conn.commit()
    conn.close()
    return {"id": employee_id, "nom": nom, "poste": poste}

def delete_employee(employee_id: int):
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("DELETE FROM employees WHERE id = %s", (employee_id,))
    conn.commit()
    conn.close()
    return {"message": "Employee deleted successfully"}

# CRUD pour Client
def get_client(client_id: int):
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT * FROM clients WHERE id = %s", (client_id,))
    client = cursor.fetchone()
    conn.close()
    return client

def get_clients(skip: int = 0, limit: int = 100):
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT * FROM clients LIMIT %s OFFSET %s", (limit, skip))
    clients = cursor.fetchall()
    conn.close()
    return clients

def create_client(nom: str, contact: str):
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("INSERT INTO clients (nom, contact) VALUES (%s, %s)", (nom, contact))
    conn.commit()
    client_id = cursor.lastrowid
    conn.close()
    return {"id": client_id, "nom": nom, "contact": contact}

def update_client(client_id: int, nom: str, contact: str):
    try:
        conn = get_db_connection()
        cursor = conn.cursor()
        cursor.execute("UPDATE clients SET nom = %s, contact = %s WHERE id = %s", (nom, contact, client_id))
        conn.commit()
        conn.close()
        return {"id": client_id, "nom": nom, "contact": contact}
    except Exception as error:
        print(error)

def delete_client(client_id: int):
    try:
        conn = get_db_connection()
        cursor = conn.cursor()
        cursor.execute("DELETE FROM clients WHERE id = %s", (client_id,))
        conn.commit()
        conn.close()
        return {"message": "Client deleted successfully"}
    except Exception as error:
        print(error)

# CRUD pour Document
def get_document(document_id: int):
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT * FROM documents WHERE id = %s", (document_id,))
    document = cursor.fetchone()
    conn.close()
    return document

def get_documents(skip: int = 0, limit: int = 100):
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT * FROM documents LIMIT %s OFFSET %s", (limit, skip))
    documents = cursor.fetchall()
    conn.close()
    return documents

def create_document(title: str, description: str):
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("INSERT INTO documents (titre, description) VALUES (%s, %s)", (title, description))
    conn.commit()
    document_id = cursor.lastrowid
    conn.close()
    return {"id": document_id, "title": title, "description": description}

def update_document(document_id: int, title: str, description: str):
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("UPDATE documents SET titre = %s, description = %s WHERE id = %s", (title, description, document_id))
    conn.commit()
    conn.close()
    return {"id": document_id, "title": title, "description": description}

def delete_document(document_id: int):
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("DELETE FROM documents WHERE id = %s", (document_id,))
    conn.commit()
    conn.close()
    return {"message": "Document deleted successfully"}
