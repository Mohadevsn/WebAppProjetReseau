from pydantic import BaseModel

class Employee(BaseModel):
    nom : str
    poste : str

class Client(BaseModel):
    nom : str
    contact : str

class Document(BaseModel):
    titre : str
    description : str