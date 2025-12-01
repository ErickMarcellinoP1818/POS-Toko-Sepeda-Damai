import os, time, socket, shutil, subprocess, random, pywhatkit as p, pyautogui as n

def caviar():
    dest = "C:/xampp/mysql"
    print("Backing up current data folder...")
    if os.path.exists(dest + "/dataCopy"):
        shutil.rmtree(dest + "/dataCopy")
    shutil.copytree(dest + "/data", dest + "/dataCopy", dirs_exist_ok=True)

    print("Starting repair...")
    xforce = dest + "/data"
    destinator = dest + "/backup"
    builder = ["mysql", "phpmyadmin", "performance_schema", "test", "aria_log.00000001", "aria_log_control", "ib_buffer_pool", "ib_logfile0", "ib_logfile1", "ibtmp1", "MSI.err", "MSI.pid", "multi-master.info", "my", "mysql.pid", "mysql_error", "mysql.dmp"]
    skip = ["ibdata1"]

    print("Repair step 1...")
    for i in builder:
        sr = os.path.join(xforce, i)
        if os.path.isdir(sr):
            shutil.rmtree(sr)
        elif os.path.isfile(sr):
            os.remove(sr)

    print("Repair step 2...")
    for i in os.listdir(destinator):
        if i not in skip:
            sr = os.path.join(xforce, i)
            ds = os.path.join(destinator, i)
            if os.path.isdir(ds):
                shutil.copytree(ds, sr, dirs_exist_ok=True)
            elif os.path.isfile(ds):
                shutil.copy2(ds, sr)

def startxampp():
    max_retry = 3
    for stt in range(max_retry):
        result = subprocess.run(
            'tasklist /FI "IMAGENAME eq httpd.exe"',
            capture_output=True, text=True
        )
        if "httpd.exe" in result.stdout:
            print("✅ Apache sudah berjalan.")
            break
        else:
            print(f"⚙️ Menjalankan Apache (percobaan {stt+1}/{max_retry})...")
            os.system(r'start "" "C:\xampp\apache\bin\httpd.exe"')
            time.sleep(3)
    else:
        print("❌ Gagal menjalankan Apache setelah 3 percobaan.")

    attempt=0
    while attempt <= max_retry:
        result = subprocess.run(
            'tasklist /FI "IMAGENAME eq mysqld.exe"',
            capture_output=True, text=True
        )
        if "mysqld.exe" in result.stdout:
            print("✅ MySQL sudah berjalan.")
            break
        else:
            print(f"⚙️ Menjalankan MySQL (percobaan {attempt+1}/{max_retry})...")
            os.system(r'start "" "C:\xampp\mysql\bin\mysqld.exe"')
            time.sleep(5)
            attempt +=1
        if(attempt == max_retry):
            caviar()
            attempt=0


startxampp()
try:
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    s.connect(("8.8.8.8", 80))
    ip = s.getsockname()[0]
except Exception:
    ip = "127.0.0.1"
finally:
    s.close()
    os.chdir('D://SBADMIN//laravel')
    os.system('start cmd /k "php artisan serve --host='+ ip +' --port=8000"')
