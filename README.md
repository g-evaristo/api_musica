# 🎵 Music API (PHP + MySQL)

This repository contains a **RESTful API** built with **PHP** and **MySQL** to manage artists and their songs.  
It allows creating artists and songs, storing song details, and linking songs to artists.

---

## 📡 API Routes

### **POST /artista**
Create a new artist.

**Headers**
- Content-Type: application/json

**Request Body Example**
```json
{
  "nome": "Artist Name",
  "data": "1990-05-20",
  "foto": "https://example.com/foto.jpg",
  "biografia": "Short biography of the artist."
}
```

---

### **GET /artista**
Retrieve all artists.

**Response Example**
```json
[
  {
    "id": 1,
    "nome": "Artist Name",
    "data": "1990-05-20",
    "foto": "https://example.com/foto.jpg",
    "biografia": "Short biography of the artist."
  }
]
```

---

### **POST /musica**
Create a new song.

**Headers**
- Content-Type: application/json

**Request Body Example**
```json
{
  "titulo": "Song Title",
  "duracao": "03:45",
  "capa": "https://example.com/capa.jpg",
  "nome": "Artist Name"
}
```

---

### **GET /musica**
Retrieve all songs along with their artists.

**Response Example**
```json
[
  {
    "titulo": "Song Title",
    "nome": "Artist Name"
  }
]
```

---

## 📊 Database Schema (ER Diagram)

```
+-----------+       +------------+       +------------------+
|  ARTISTA  |       |  MUSICA    |       | ARTISTA_MUSICA   |
+-----------+       +------------+       +------------------+
| ID (PK)   |       | ID (PK)    |       | ID (PK)          |
| NOME      |       | TITULO     |       | FK_ARTISTA_ID(FK)|
| DATA      |       | DURACAO    |       | FK_MUSICA_ID(FK) |
| FOTO      |       | CAPA       |       +------------------+
| BIOGRAFIA |       +------------+
+-----------+
```

- **ARTISTA**: Stores artists with name, birthdate, photo, and biography.  
- **MUSICA**: Stores songs with title, duration, and cover image.  
- **ARTISTA_MUSICA**: Links artists to songs (many-to-many relationship).  

---

## 📌 Notes
- All requests and responses use **JSON** format.  
- The API supports multiple artists per song.  
- Cascade deletion ensures that deleting an artist or song removes the associated links automatically.
