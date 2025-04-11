/* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Variabili per tonalità di blu */
:root {
    --primary-dark: #0a2463;    /* Blu scuro */
    --primary: #1e3a8a;         /* Blu principale */
    --primary-light: #3b82f6;   /* Blu chiaro */
    --accent: #38bdf8;          /* Blu cielo / accent */
    --dark: #1e293b;            /* Blu quasi nero */
    --light: #f1f5f9;           /* Grigio chiaro */
    --white: #ffffff;           /* Bianco */
    --shadow: rgba(10, 36, 99, 0.15); /* Ombra blu */
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--light);
    color: var(--dark);
    line-height: 1.6;
}

/* Header */
header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: var(--white);
    padding: 1.5rem;
    box-shadow: 0 4px 12px var(--shadow);
}

.header-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 1.8rem;
    font-weight: 700;
}

/* Navigazione */
nav ul {
    display: flex;
    list-style: none;
}

nav ul li {
    margin-left: 1.5rem;
}

nav ul li a {
    color: var(--white);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

nav ul li a:hover {
    color: var(--accent);
}

/* Contenitore principale */
.container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

/* Sezioni */
section {
    margin-bottom: 2rem;
    padding: 2rem;
    background-color: var(--white);
    border-radius: 8px;
    box-shadow: 0 2px 10px var(--shadow);
}

.section-title {
    color: var(--primary);
    margin-bottom: 1rem;
    font-size: 1.5rem;
    position: relative;
    padding-bottom: 0.5rem;
}

.section-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background-color: var(--primary-light);
}

/* Pulsanti */
.btn {
    display: inline-block;
    padding: 0.6rem 1.5rem;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
    border: none;
}

.btn-primary {
    background-color: var(--primary);
    color: var(--white);
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    box-shadow: 0 4px 8px var(--shadow);
}

.btn-outline {
    background-color: transparent;
    color: var(--primary);
    border: 2px solid var(--primary);
}

.btn-outline:hover {
    background-color: var(--primary);
    color: var(--white);
}

/* Card */
.card {
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 2px 8px var(--shadow);
    margin-bottom: 1.5rem;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px var(--shadow);
}

.card-header {
    background-color: var(--primary);
    color: var(--white);
    padding: 1rem;
}

.card-body {
    padding: 1.5rem;
    background-color: var(--white);
}

/* Form */
.form-group {
    margin-bottom: 1.2rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--primary-dark);
    font-weight: 500;
}

input, select, textarea {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    font-family: inherit;
    transition: border 0.3s ease, box-shadow 0.3s ease;
}

input:focus, select:focus, textarea:focus {
    outline: none;
    border-color: var(--primary-light);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}

/* Tabelle */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
}

th, td {
    padding: 0.75rem;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
}

th {
    background-color: rgba(30, 58, 138, 0.1);
    color: var(--primary-dark);
    font-weight: 600;
}

tr:hover {
    background-color: rgba(59, 130, 246, 0.05);
}

/* Alert/messaggi */
.alert {
    padding: 1rem;
    border-radius: 4px;
    margin-bottom: 1.5rem;
    border-left: 4px solid;
}

.alert-info {
    background-color: rgba(56, 189, 248, 0.1);
    border-left-color: var(--accent);
    color: var(--primary-dark);
}

.alert-success {
    background-color: rgba(34, 197, 94, 0.1);
    border-left-color: #22c55e;
    color: #166534;
}

.alert-warning {
    background-color: rgba(245, 158, 11, 0.1);
    border-left-color: #f59e0b;
    color: #92400e;
}

.alert-error {
    background-color: rgba(239, 68, 68, 0.1);
    border-left-color: #ef4444;
    color: #b91c1c;
}

/* Footer */
footer {
    background-color: var(--primary-dark);
    color: var(--white);
    padding: 2rem 0;
    margin-top: 3rem;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.footer-column h3 {
    font-size: 1.2rem;
    margin-bottom: 1rem;
    color: var(--accent);
}

.footer-links {
    list-style: none;
}

.footer-links li {
    margin-bottom: 0.5rem;
}

.footer-links a {
    color: #cbd5e1;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-links a:hover {
    color: var(--accent);
}

.copyright {
    text-align: center;
    padding-top: 2rem;
    margin-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    color: #cbd5e1;
    font-size: 0.9rem;
}

/* Responsive */
@media screen and (max-width: 768px) {
    .header-container {
        flex-direction: column;
        text-align: center;
    }
    
    nav ul {
        margin-top: 1rem;
        justify-content: center;
    }
    
    nav ul li {
        margin: 0 0.75rem;
    }
}

/* Classe per la home */
.home-content {
    background-color: var(--white);
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px var(--shadow);
    text-align: center;
    margin-top: 2rem;
}

.home-title {
    color: var(--primary);
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
}

.home-description {
    font-size: 1.1rem;
    color: var(--dark);
    max-width: 800px;
    margin: 0 auto 2rem;
}

/* Utile per debug */
.debug-info {
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 1rem;
    margin: 1rem 0;
    font-family: monospace;
    font-size: 0.9rem;
    color: #64748b;
    max-height: 300px;
    overflow: auto;
}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            require_once("Classi/GestoreDatabase.php");
            require_once("Classi/Utente.php");

            if(!isset($_SESSION)) {
                session_start();
            }
            print_r($_SESSION);


            ?>
            HOMEEEEEEEEEEEEEEEEEEEEEEE
    </body>
</html>
