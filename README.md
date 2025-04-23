# Web-App Suggestion-Box
KotakSaran adalah platform kolaborasi dua arah antara pengguna dan administrator yang memungkinkan pengiriman saran/masukan secara digital dengan sistem tracking terintegrasi. Dibangun menggunakan framework CodeIgniter 4, aplikasi ini menyediakan solusi modern untuk manajemen saran institusi/organisasi dengan fitur lengkap dan keamanan terjamin.
Berikut deskripsi lengkap untuk Web Application "Kotak Saran Online":

### **Fitur Utama**  
✅ **Dual Role System**:  
   - **Pengguna Umum**  
     ✦ Kirim saran/masukan secara anonim atau terdaftar  
     ✦ Lacak status saran (Terbaca/Belum terbaca)  
     ✦ Lihat riwayat tanggapan admin  
     ✦ Dashboard personal dengan statistik saran  

   - **Administrator**  
     ✦ Sistem autentikasi multi-level dengan hashing password  
     ✦ Dashboard analitik real-time  
     ✦ Manajemen saran terpusat  
     ✦ Sistem respon terstruktur  
     ✦ Monitoring aktivitas pengguna  

✅ **Core Functionality**:  
   - Formulir pengiriman saran dengan validasi server-side  
   - Sistem notifikasi status saran otomatis  
   - Pencatatan waktu (timestamp) untuk semua transaksi  
   - History audit lengkap (Saran & Tanggapan)  
   - Export data ke format CSV/Excel  

---

### **Teknologi Utama**  
🛠 **Backend**:  
- CodeIgniter 4 MVC Framework  
- MySQL Database dengan relasi tabel kompleks  
- Active Record Database Abstraction  
- Session Management dengan enkripsi  

🖥 **Frontend**:  
- AdminLTE 3 Dashboard Template  
- Responsive Web Design  
- Component-based UI Architecture  
- Native JavaScript + jQuery  

🔒 **Security**:  
- Password Hashing (BCrypt)  
- CSRF Protection  
- XSS Filtering  
- Role-based Access Control  
- Session Timeout  

---

### **Use Case**  
💼 **Untuk Organisasi**:  
- Media penerimaan aspirasi anggota/stakeholder  
- Sistem pengaduan internal terstruktur  
- Tools komunikasi dua arah manajemen-karyawan  

🏫 **Untuk Institusi Pendidikan**:  
- Kotak saran digital modern  
- Media komunikasi siswa-pengelola  
- Sistem pengumpulan feedback akademik  

🏥 **Untuk Layanan Publik**:  
- Channel pengaduan masyarakat  
- Media monitoring kualitas layanan  
- Sistem respon cepat keluhan pengguna  

---

### **Keunggulan Sistem**  
1. **Real-time Tracking** - Lacak status saran secara live  
2. **Multi-user Environment** - Dukung banyak pengguna simultan  
3. **Audit Trail** - Pencatatan riwayat perubahan lengkap  
4. **Modular Design** - Mudah dikembangkan lebih lanjut  
5. **Cost Effective** - Mengurangi biaya operasional sistem manual  

---

### **Screenshoot Konsep Antarmuka**  
*(Contoh visual interface berdasarkan AdminLTE)*  
1. **Dashboard Admin**:  
   - Data visual grafik pie & bar  
   - Quick access menu  
   - System health monitor  

2. **Form Saran Pengguna**:  
   - Clean modern design  
   - Progress indicator  
   - WYSIWYG editor  

3. **Panel Tanggapan**:  
   - Threaded comment system  
   - Attachment support  
   - Status badge indicator  

---

**Target Pengguna**:  
- Perusahaan/Startup  
- Instansi pemerintah  
- Lembaga pendidikan  
- Organisasi masyarakat  
- Rumah sakit/klinik  
