package com.maxpilotto.acme.tasks;

import android.support.annotation.NonNull;

import com.maxpilotto.acme.objects.Update;
import com.maxpilotto.acme.utils.ACMEHttpResponseListener;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

/**
 * Project: ACME
 * Created by: Max
 * Date: 24/04/2018 @ 20:47
 * Package: com.maxpilotto.acme.tasks
 */
public class SubmitMovement extends ACMEHttpRequest {
    private Update update;

    public SubmitMovement(String username, String password, @NonNull ACMEHttpResponseListener listener, Update update) {
        super(username, password, listener);
        this.update = update;
    }

    @Override
    protected String doInBackground(Void... voids) {
        try {
            // NOTE To access the database on the same machine the address is note 127.0.0.1 or localhost, it's 10.0.2.2
            // Reference: https://developer.android.com/studio/run/emulator-networking
            // TODO change the url

            HttpURLConnection connection = (HttpURLConnection) new URL("http://10.0.2.2:80/fleet-management-sample/site/service/submitMovement.php").openConnection();
            BufferedReader buffer = new BufferedReader(new InputStreamReader(connection.getInputStream()));
            StringBuilder result = new StringBuilder();
            String tmp;

            connection.setDoOutput(true);
            connection.setDoInput(true);
            connection.setRequestMethod("POST");
            connection.addRequestProperty("username",username);
            connection.addRequestProperty("passwd",password);
            connection.addRequestProperty("movDate",update.getDate().toString());
            connection.addRequestProperty("movTime",update.getTime().toString());
            connection.addRequestProperty("latitude",String.valueOf(update.getLatitude()));
            connection.addRequestProperty("longitude",String.valueOf(update.getLongitude()));
            connection.addRequestProperty("shipment",String.valueOf(update.getShipment()));

            while((tmp = buffer.readLine()) != null){
                result.append(tmp);
                result.append("\n");
            }

            return result.toString();
        } catch (IOException e) {
            e.printStackTrace();
        }

        return null;
    }
}
