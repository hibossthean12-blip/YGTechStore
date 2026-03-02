# 🛒 YG Tech Store - Managed Laravel Application

This is a customized Laravel e-commerce application, optimized for deployment on **Render** using **PostgreSQL**.

## 🚀 Quick Start for New Developers

Follow these steps to get the environment running exactly like the production server.

### 1. Clone & Install
```bash
git clone https://github.com/hibossthean12-blip/YGTechStore.git
cd YGTechStore
composer install
npm install
```

### 2. Environment Setup (CRITICAL)
Copy the example environment file and fill in the Render Postgres details.
```bash
cp .env.example .env
php artisan key:generate
```
**Required `.env` values for Postgres:**
- `DB_CONNECTION=pgsql`
- `DB_URL`: (Get this from Render Postgres dashboard -> Internal Database URL)
- `DB_SSLMODE=require`

### 3. Build & Deploy
This project uses Docker. Every push to `main` triggers a build on Render.
```bash
git add .
git commit -m "Your changes"
git push origin main
```

---

## 📖 Essential Documentation
We have created detailed guides for specific tasks:
1.  [**Handover Guide (CONTRIBUTING.md)**](./CONTRIBUTING.md): Overview of the current project state and technical stack.
2.  [**Step-by-Step Walkthrough (walkthrough.md)**](./walkthrough.md): How to connect **pgAdmin**, fix SSL errors, and manage Render deployments.

---

## 🗄️ Database Management
The database is currently in a **"Clean State"**:
- **Admin Login**: `admin@techstore.com` / `password`.
- **Products**: Wiped/Empty.
- **Categories**: Restored (Audio, Wearables, Computers, Photography, Accessories, Mobile).
- **Auto-Sync**: The `DatabaseSeeder.php` is configured to **wipe and re-seed** the clean state on every deploy.

---

## 🛠️ Technical Overview
- **Framework**: Laravel 11.x
- **Database**: PostgreSQL (Managed on Render)
- **Container**: Docker (with Alpine Linux/Nginx/PHP-FPM)
- **Deployment**: Automatic via Render branch tracking.

---

## 🤝 Handover Credits
Created for **YG Tech Store**. Optimized for high-reliability deployments and easy scalability.
