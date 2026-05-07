<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?? 'SPK Moora Borda' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { 
            background-color: #f8f9fc; 
            overflow-x: hidden; 
        }
        
        #wrapper { 
            display: flex; 
            width: 100%; 
            transition: all 0.3s ease; /* Animasi halus pada wrapper */
        }
        
        #sidebar-wrapper { 
            min-height: 100vh; 
            width: 15rem; /* Lebar Sidebar */
            margin-left: 0; /* DEFAULT: MUNCUL */
            transition: margin .3s ease-out; 
            background-color: #4e73df; 
            color: white; 
            flex-shrink: 0; /* Jangan menyusut */
        }
        
        /* KELAS KHUSUS SAAT TOMBOL DIKLIK (SEMBUNYI) */
        #wrapper.toggled #sidebar-wrapper { 
            margin-left: -15rem; /* Geser ke kiri sampai hilang */
        }
        
        #sidebar-wrapper .sidebar-heading { padding: 0.875rem 1.25rem; font-size: 1.2rem; font-weight: bold; border-bottom: 1px solid rgba(255,255,255,0.2); }
        #sidebar-wrapper .list-group { width: 15rem; }
        #page-content-wrapper { width: 100%; flex-grow: 1; } /* Konten memenuhi sisa layar */
        
        .list-group-item { background-color: transparent; color: rgba(255,255,255,0.8); border: none; }
        .list-group-item:hover, .list-group-item.active { background-color: rgba(255,255,255,0.2); color: #fff; font-weight: bold; }
        .card { border: none; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15); }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">