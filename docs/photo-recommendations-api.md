# Photo Recommendations API Documentation

API untuk mengelola rekomendasi gaya foto dengan kategori dan tips fotografi.

## 📡 Endpoints

### 1. Get All Photo Recommendations
```
GET /api/photo-recommendations
```

**Response:**
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 13,
      "title": "Gaya Foto 1",
      "category": "portrait",
      "image": "photos/gya fto 2.avif",
      "description": "Pose duduk santai yang cocok untuk foto outdoor dengan background alam",
      "tips": "Pilih lokasi dengan cahaya natural yang lembut, seperti sore hari. Posisikan tubuh sedikit miring untuk hasil lebih dinamis.",
      "is_active": true,
      "created_at": "2026-01-05T08:40:13.000000Z",
      "updated_at": "2026-01-05T08:40:13.000000Z",
      "image_url": "/storage/photos/gya fto 2.avif"
    }
  ],
  "per_page": 15,
  "total": 24
}
```

---

### 2. Filter by Category
```
GET /api/photo-recommendations?category={category}
```

**Available Categories:**
- `portrait` - Foto potret
- `nature` - Foto alam
- `urban` - Foto perkotaan
- `travel` - Foto perjalanan
- `landscape` - Pemandangan
- `wildlife` - Satwa liar
- `architecture` - Arsitektur

**Example:**
```bash
GET /api/photo-recommendations?category=portrait
```

---

### 3. Search Recommendations
```
GET /api/photo-recommendations?search={keyword}
```

Mencari di field: `title`, `description`, dan `tips`.

**Example:**
```bash
GET /api/photo-recommendations?search=golden
```

---

### 4. Pagination
```
GET /api/photo-recommendations?per_page={number}
```

**Default:** 15 items per page

**Example:**
```bash
GET /api/photo-recommendations?per_page=10
```

---

### 5. Get Single Recommendation
```
GET /api/photo-recommendations/{id}
```

**Response:**
```json
{
  "id": 13,
  "title": "Gaya Foto 1",
  "category": "portrait",
  "image": "photos/gya fto 2.avif",
  "description": "Pose duduk santai yang cocok untuk foto outdoor dengan background alam",
  "tips": "Pilih lokasi dengan cahaya natural yang lembut...",
  "is_active": true,
  "created_at": "2026-01-05T08:40:13.000000Z",
  "updated_at": "2026-01-05T08:40:13.000000Z",
  "image_url": "/storage/photos/gya fto 2.avif"
}
```

**Error Response (404):**
```json
{
  "message": "Photo recommendation not found"
}
```

---

## 🔗 Combined Filters

Anda bisa menggabungkan filter:

```bash
GET /api/photo-recommendations?category=portrait&search=elegan&per_page=5
```

---

## 🧪 Testing dengan cURL

```bash
# Get all
curl http://localhost:8000/api/photo-recommendations

# Filter by category
curl http://localhost:8000/api/photo-recommendations?category=urban

# Search
curl http://localhost:8000/api/photo-recommendations?search=santai

# Get single item
curl http://localhost:8000/api/photo-recommendations/13
```

---

## 🧪 Testing dengan PowerShell

```powershell
# Get all
Invoke-RestMethod -Uri "http://localhost:8000/api/photo-recommendations"

# Filter by category
Invoke-RestMethod -Uri "http://localhost:8000/api/photo-recommendations?category=portrait"

# Search
Invoke-RestMethod -Uri "http://localhost:8000/api/photo-recommendations?search=golden"

# Get single item
Invoke-RestMethod -Uri "http://localhost:8000/api/photo-recommendations/13"
```

---

## 📊 Database Schema

```sql
photo_recommendations
├── id (bigint, primary key)
├── title (varchar)
├── category (varchar, nullable)
├── image (varchar, nullable)
├── description (text, nullable)
├── tips (text, nullable)
├── is_active (boolean, default: true)
├── created_at (timestamp)
└── updated_at (timestamp)
```

---

## 🎯 Tips Penggunaan

1. **Untuk landing page:** Tampilkan random 6-8 recommendations
   ```
   GET /api/photo-recommendations?per_page=8
   ```

2. **Untuk kategori page:** Filter berdasarkan kategori
   ```
   GET /api/photo-recommendations?category=travel
   ```

3. **Untuk search feature:** Gunakan parameter search
   ```
   GET /api/photo-recommendations?search={query}
   ```

---

## ✨ Features

- ✅ Pagination otomatis
- ✅ Filter by category
- ✅ Full-text search (title, description, tips)
- ✅ Image URL auto-generated
- ✅ Only return active recommendations
- ✅ Error handling 404
- ✅ RESTful API structure
