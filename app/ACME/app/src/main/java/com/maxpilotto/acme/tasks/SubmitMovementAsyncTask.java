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
public class SubmitMovementAsyncTask extends AsyncTask<Void,Void,Void> {
    private Update update;
	private String username;
	private String password;

    public SubmitMovementAsyncTask(Update update,String username,String password){
        this.update = update;
		this.username = username;
		this.password = password;
    }

    @Override
    protected Void doInBackground(Void... voids) {
        try {
            HttpURLConnection connection = (HttpURLConnection) new URL("http://localhost:80/fleet-management-sample/site/service/submitMovement.php").openConnection();
			StringBuffer buffer = new StringBuffer();
			
			
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
    protected void onPostExecute(Void void) {
        super.onPostExecute(void);
    }
}
