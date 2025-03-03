from pydantic import BaseModel

class EmployeBase(BaseModel):
    nom: str
    poste: str

class EmployeCreate(EmployeBase):
    pass

class Employe(EmployeBase):
    id: int

    class Config:
        orm_mode = True

class ClientBase(BaseModel):
    nom: str
    contact: str

class ClientCreate(ClientBase):
    pass

class Client(ClientBase):
    id: int

    class Config:
        orm_mode = True

class DocumentBase(BaseModel):
    title: str
    decription: str

class DocumentCreate(DocumentBase):
    pass

class Document(DocumentBase):
    id: int

    class Config:
        orm_mode = True