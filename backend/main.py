from fastapi import FastAPI, status
import crud
from models import Employee, Client, Document

app = FastAPI()

@app.get("/")
def root():
    return {"Welcome to the api"}

@app.post("/create_employee")
def create_employee(data: Employee):
    employee = crud.create_employee(data.nom, data.poste)
    return {"message": "employee created", "employee": employee}

@app.get("/get_employee/{employee_id}")
def get_employee(employee_id: int):
    employee = crud.get_employee(employee_id)
    return {"message": "employee", "data": employee,"status_code": status.HTTP_200_OK}

@app.get("/get_employees")
def get_employee():
    employees = crud.get_employees()
    return {"message": "employees", "data": employees,"status_code": status.HTTP_200_OK}

@app.put("/update_employee/{employee_id}")
def update_employee(employee_id: int, data: Employee):
    employee = crud.update_employee(employee_id, data.nom, data.poste)
    return {"message": "employee updated", "id": employee_id, "data": employee}

@app.delete("/delete/{employee_id}")
def delete_employee(employee_id: int):
    crud.delete_employee(employee_id)
    return {"message": "employee deleted", "employee_id": employee_id}

# clients routes

@app.post("/create_client")
def create_client(data: Client):
    client = crud.create_client(data.nom, data.contact)
    return {"message": "client created", "client": client}

@app.get("/get_client/{client_id}")
def get_client(client_id: int):
    client = crud.get_client(client_id)
    return {"message": "client", "data": client,"status_code": status.HTTP_200_OK}

@app.get("/get_clients")
def get_client():
    clients = crud.get_clients()
    return {"message": "clients", "data": clients,"status_code": status.HTTP_200_OK}

@app.put("/update_client/{client_id}")
def update_client(client_id: int, data: Client):
    client = crud.update_client(client_id, data.nom, data.contact)
    return {"message": "client updated", "id": client_id, "data": client}

@app.delete("/delete/{client_id}")
def delete_client(client_id: int):
    crud.delete_client(client_id)
    return {"message": "client deleted", "client_id": client_id}

#  document

@app.post("/create_document")
def create_document(data: Document):
    document = crud.create_document(data.titre, data.description)
    return {"message": "document created", "document": document}

@app.get("/get_document/{document_id}")
def get_document(document_id: int):
    document = crud.get_document(document_id)
    return {"message": "document", "data": document,"status_code": status.HTTP_200_OK}

@app.get("/get_documents")
def get_document():
    documents = crud.get_documents()
    return {"message": "documents", "data": documents,"status_code": status.HTTP_200_OK}

@app.put("/update_document/{document_id}")
def update_document(document_id: int, data: Document):
    document = crud.update_document(document_id, data.titre, data.description)
    return {"message": "document updated", "id": document_id, "data": document}

@app.delete("/delete/{document_id}")
def delete_document(document_id: int):
    crud.delete_document(document_id)
    return {"message": "document deleted", "document_id": document_id}