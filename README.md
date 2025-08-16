# 💻 Internet Banking System  

## 📌 Project Overview  
The **Internet Banking System** is a web-based application that allows users to perform basic banking operations such as viewing customer details, checking balances, transferring money between users, and viewing transaction history.  

This project is developed using **HTML, CSS, JavaScript, PHP**, and **MySQL** for database management. It demonstrates the core functionalities of an online banking system in a simplified way.  

---

## 🛠️ Technologies Used  

### 🔹 Languages  
- HTML  
- CSS  
- JavaScript  
- PHP  

### 🔹 Database  
- MySQL  

---

## ⚙️ Software Requirements  

To run this project, install the following:  

1. **XAMPP**  
   - Download Link: [XAMPP](https://www.apachefriends.org/)  
   - Install according to your system configuration.  

2. **Code Editor (Any one of the following):**  
   - [Visual Studio Code](https://code.visualstudio.com/download)  
   - [Notepad++](https://notepad-plus-plus.org/downloads/)  
   - [Sublime Text](https://www.sublimetext.com/)
     
3. **FILE FORMAT**
      - os/xampp/htdots/rkbank
      - File should be arrange in this order
---

## 🚀 Steps to Run the Project  

1. Install all required software.
2. Install XAMPP and open
3. Click to Start the Apache and MySQL servers from the XAMPP control panel.
4. Again click the Admin ( MySQL)
5. Open **phpMyAdmin** (through XAMPP) and **import the database file** `customerdb.sql`.  
6. Open your browser (Chrome/Firefox/etc.).  
7. http://localhost/rkbank/index.html
8. Run the project.

---

## 🗄️ Database Structure  

### 1️⃣ Users Table  
- **id** (Primary Key)  
- **name** (Customer Name)  
- **email** (Customer Email)  
- **current_balance** (Available Balance)  

### 2️⃣ Transactions Table  
- **id** (Primary Key)  
- **sender** (User who sends money)  
- **receiver** (User who receives money)  
- **amount** (Transaction Amount)  
- **date_time** (Timestamp of transfer)  

---

## 🌐 Website Flow  

1. **Home Page** → Introduction to the system.  
2. **View All Users** → Displays all registered users with details.  
3. **Select & View One User** → Shows specific user profile and balance.  
4. **Transfer Money** → User selects another user to transfer money.  
5. **Select Receiver** → Confirm and process the transfer.  
6. **View All Users Again** → Updated balances are shown.  
7. **View Transaction History** → Displays all previous transfers with timestamp.  

---

## 📸 Screenshots  

### 🏠 Home Page  
<img width="1898" height="907" alt="Home Page" src="https://github.com/user-attachments/assets/1091b5d8-5c16-41d9-8142-70d8cbc754ca" />

### 👥 View All Users  
<img width="1903" height="901" alt="All Users" src="https://github.com/user-attachments/assets/cbbf2431-516d-4be6-9647-8e1d3326df6f" />

### 👤 User Details  
<img width="1919" height="888" alt="User Details" src="https://github.com/user-attachments/assets/8948a432-0e32-4e6e-9565-e04f18fd08f6" />

### 💸 Transfer Money  
<img width="1919" height="913" alt="Transfer Money" src="https://github.com/user-attachments/assets/5d4b7d1e-e3b0-4fbe-90d0-77ed9cc9e98d" />

### 📜 Transaction History  
<img width="1917" height="906" alt="Transaction History" src="https://github.com/user-attachments/assets/2acf5c8a-1246-4577-b9ed-d380fdbd6b7e" />

---

## ✅ Conclusion  
This project demonstrates the **basic workflow of an Internet Banking System** while providing hands-on learning in **web development using PHP and MySQL**.  
---

## 📜 License  

This project is licensed under the **MIT License** – see the [LICENSE](LICENSE) file for details.  

---
