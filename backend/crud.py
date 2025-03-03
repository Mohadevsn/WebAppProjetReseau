from sqlalchemy.orm import Session
from models import Employee, Client, Document
from schema import EmployeBase, EmployeCreate, Employe, ClientCreate, DocumentCreate

# CRUD pour Employee
def get_employee(db: Session, employee_id: int):
    return db.query(Employee).filter(Employee.id == employee_id).first()

def get_employees(db: Session, skip: int = 0, limit: int = 100):
    return db.query(Employee).offset(skip).limit(limit).all()

def create_employee(db: Session, employee: EmployeCreate):
    db_employee = Employee(name=employee.name, position=employee.position)
    db.add(db_employee)
    db.commit()
    db.refresh(db_employee)
    return db_employee

# CRUD pour Client
def get_client(db: Session, client_id: int):
    return db.query(Client).filter(Client.id == client_id).first()

def get_clients(db: Session, skip: int = 0, limit: int = 100):
    return db.query(Client).offset(skip).limit(limit).all()

def create_client(db: Session, client: ClientCreate):
    db_client = Client(name=client.name, contact=client.contact)
    db.add(db_client)
    db.commit()
    db.refresh(db_client)
    return db_client

# CRUD pour Document
def get_document(db: Session, document_id: int):
    return db.query(Document).filter(Document.id == document_id).first()

def get_documents(db: Session, skip: int = 0, limit: int = 100):
    return db.query(Document).offset(skip).limit(limit).all()

def create_document(db: Session, document: DocumentCreate):
    db_document = Document(title=document.title, description=document.description)
    db.add(db_document)
    db.commit()
    db.refresh(db_document)
    return db_document