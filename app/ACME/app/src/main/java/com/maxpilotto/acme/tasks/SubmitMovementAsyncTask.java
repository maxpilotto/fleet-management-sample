package com.maxpilotto.acme.tasks;

import android.os.AsyncTask;

import com.maxpilotto.acme.objects.Update;

import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.URL;

/**
 * Project: ACME
 * Created by: Max
 * Date: 24/04/2018 @ 20:47
 * Package: com.maxpilotto.acme.tasks
 */
public class SubmitMovementAsyncTask extends AsyncTask<Void,Void,Update> {
    private Update update;

    public SubmitMovementAsyncTask(Update update,String username,String password){
        this.update = update;
    }

    @Override
    protected Update doInBackground(Void... voids) {
        try {
            HttpURLConnection connection = (HttpURLConnection) new URL("http://localhost:80/fleet-management-sample/site/service/submitMovement.php").openConnection();

            connection.setDoOutput(true);
            connection.setDoInput(true);
            connection.setRequestMethod("POST");
            connection.addRequestProperty("movDate",update.getDate().toString());
            connection.addRequestProperty("movTime",update.getTime().toString());
            connection.addRequestProperty("latitude",String.valueOf(update.getLatitude()));
            connection.addRequestProperty("longitude",String.valueOf(update.getLongitude()));
            connection.addRequestProperty("shipment",String.valueOf(update.getShipment()));

        } catch (IOException e) {
            e.printStackTrace();
        }

        return null;
    }

    @Override
    protected void onPreExecute() {
        super.onPreExecute();
    }

    @Override
    protected void onPostExecute(Update update) {
        super.onPostExecute(update);
    }
}
