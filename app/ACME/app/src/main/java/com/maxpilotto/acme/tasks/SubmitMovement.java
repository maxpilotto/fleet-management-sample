            // NOTE To access the database on the same machine the address is note 127.0.0.1 or localhost, it's 10.0.2.2
            // Reference: https://developer.android.com/studio/run/emulator-networking
            // TODO change the url

            HttpURLConnection connection = (HttpURLConnection) new URL("http://10.0.2.2 :80/fleet-management-sample/site/service/submitMovement.php").openConnection();
