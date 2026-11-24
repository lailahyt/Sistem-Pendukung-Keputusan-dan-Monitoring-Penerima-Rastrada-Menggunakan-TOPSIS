# Decision Support and Monitoring System for Rastrada Aid Recipients (TOPSIS)

A web app that helps decide who receives Rastrada aid and monitors how it is distributed. Candidates are ranked with the TOPSIS method based on criteria scored by staff. The village head (lurah) then approves the result, and distribution is tracked in the same app.

This project was developed collaboratively as an academic project (final project, "Tugas Akhir").

## Features

- **Resident data:** enter and manage data on candidate recipients. Neighborhood heads (RT/RW) can nominate residents to be scored.
- **Criteria and sub-criteria:** set weights, criterion type (benefit or cost), sub-criteria, active status, and whether a criterion requires proof.
- **Periods:** scoring and calculations are grouped by period.
- **Scoring:** staff score each candidate against the criteria.
- **TOPSIS calculation:** shows every step: decision matrix, normalization, weighted normalization, positive and negative ideal solutions, distances, preference values, and ranking.
- **Other aid:** residents who have already received other aid in the same year are excluded from the calculation.
- **Results and quota:** the village head sets the recipient quota based on the ranking.
- **Distribution monitoring:** tracks the status of aid collection, including proof of collection.
- **Reports:** export to PDF and Excel.
- **Accounts and access rights:** four roles with different access: Admin, Staff (Petugas), Village Head (Lurah), and RT/RW.

## User roles

| Role | Main tasks |
|---|---|
| Admin | Full system access, manages accounts and staff |
| Staff (Petugas) | Data entry, scoring, calculation, and monitoring |
| Village Head (Lurah) | Views results, validates and approves, sets the quota |
| RT/RW | Enters resident data and nominates residents |

## TOPSIS in brief

TOPSIS (Technique for Order Preference by Similarity to Ideal Solution) ranks options by how close they are to the ideal solution. The steps in this app:

1. Build the decision matrix from each candidate's score on each criterion.
2. Normalize the matrix, then multiply by the criteria weights.
3. Determine the positive and negative ideal solutions. For benefit criteria, the highest value is the positive ideal; for cost criteria, the lowest value is.
4. Calculate each candidate's distance to the positive and negative ideal solutions.
5. Calculate the preference value, then sort from highest to lowest.

## Tech stack

- Laravel 12 (PHP 8.2 or later)
- MySQL
- Bootstrap
- `maatwebsite/excel` for Excel export and `barryvdh/laravel-dompdf` for PDF export
- Vite

## Running it locally

Requirements: PHP 8.2+, Composer, Node.js and npm, and MySQL.

```bash
git clone https://github.com/lailahyt/Sistem-Pendukung-Keputusan-dan-Monitoring-Penerima-Rastrada-Menggunakan-TOPSIS.git
cd Sistem-Pendukung-Keputusan-dan-Monitoring-Penerima-Rastrada-Menggunakan-TOPSIS

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Create an empty MySQL database, then update the database section of your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

Then run the migrations, load the initial data, and build the frontend:

```bash
php artisan migrate --seed
npm run build
php artisan serve
```

Open `http://localhost:8000`.

### Sample accounts

The initial data (`php artisan migrate --seed`) contains roles, RT/RW area data, and three test accounts:

| Role | Email | Password |
|---|---|---|
| Admin | `admin@gmail.com` | `password` |
| Staff (Petugas) | `petugas@gmail.com` | `password` |
| Village Head (Lurah) | `lurah@gmail.com` | `password` |

RT/RW accounts are created by the Admin through the accounts menu. The accounts above are for local testing only. Change the passwords before using the app for real.

## Project structure

```
app/Services/TopsisService.php   TOPSIS calculation
app/Http/Controllers/            Residents, criteria, scoring, results, monitoring, reports
app/Exports/LaporanExport.php    Excel report export
database/migrations/             Table structure
database/seeders/                Roles, test accounts, area data
resources/views/                 Blade views
routes/web.php                   Routes and per-role access restrictions
```

## Data note

This repository contains no real resident data. All resident data, scores, and proof of collection are entered through the app and should not be published.

## Authors

- Laila Hayati — [GitHub](https://github.com/lailahyt)
- Trindah Agustina — [GitHub](https://github.com/trindah)
