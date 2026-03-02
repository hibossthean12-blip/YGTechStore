# Developer Handover Guide

Welcome! This guide will help you pick up the development of the **YG Tech Store** project.

## 🔗 Quick Links
- **Repository**: [https://github.com/hibossthean12-blip/YGTechStore.git](https://github.com/hibossthean12-blip/YGTechStore.git)
- **Deployment**: Render (Web Service + Postgres)

## 🛠️ Getting Started

### 1. Clone the Repository
```bash
git clone https://github.com/hibossthean12-blip/YGTechStore.git
cd YGTechStore
```

### 2. Environment Configuration
The `.env` file is NOT in GitHub for security. You must create one based on `.env.example`.
- **Database**: We are using **PostgreSQL** (hosted on Render).
- **Key Variables**:
  - `DB_CONNECTION=pgsql`
  - `DB_URL`: Use the **Internal Database URL** from the Render Postgres dashboard.
  - `DB_SSLMODE=require`

### 3. Essential Documentation
Please read the [**walkthrough.md**](./walkthrough.md) in the root directory. It contains:
- Instructions for connecting **pgAdmin**.
- Fixes for SSL and Build errors.
- Details on the Docker configuration.

## 🗄️ Current Database State
The database has been migrated from SQLite to PostgreSQL and is currently in a "Clean State":
- **Tables**: Fully migrated to Postgres.
- **Data Cleanup**: All previous products, ratings, and test users have been **wiped**.
- **Admin Account**: 
  - **Email**: `admin@techstore.com`
  - **Password**: `password`
- **Categories**: All 6 original categories have been restored (Audio, Wearables, Computers, Photography, Accessories, Mobile).

## 🚀 Deployment Workflow
This project uses **Docker** on Render.
- Pushing to the `main` branch automatically triggers a deploy.
- The `database/seeders/DatabaseSeeder.php` is configured to **wipe and re-seed** the Admin and Categories on every deploy to maintain a clean state.

## 🔧 Technical Notes
- **PHP Version**: 8.4
- **Database**: PostgreSQL
- **Web Server**: Nginx (running inside Docker)
- **CSS**: Vanilla CSS
- **JS**: Vanilla JS / Alpine.js (if applicable)

Happy coding!
