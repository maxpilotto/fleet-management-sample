package com.maxpilotto.trucktr4ck3r.tasks;

import android.net.Uri;
import android.os.AsyncTask;
import android.support.annotation.NonNull;
import android.util.Log;

import com.maxpilotto.trucktr4ck3r.objects.PositionUpdate;
import com.maxpilotto.trucktr4ck3r.utils.HttpResponse;
import com.maxpilotto.trucktr4ck3r.utils.HttpResponseParser;
import com.maxpilotto.trucktr4ck3r.utils.Utils;

import org.json.JSONException;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

/**
 * Project: truck-app
 * Created by: Max
 * Date: 09/05/2018 @ 16:52
 * Package: com.maxpilotto.trucktr4ck3r.tasks
 */
public class SendPositionUpdate extends AsyncTask<Void,Void,String> {
    public interface RequestListener{
        void onReceive(HttpResponse response);
    }

    private String url = "http://10.0.2.2:80/fleet-management-sample/site/service/submitMovement.php";
    private String username;
    private String password;
    private RequestListener listener;
    private PositionUpdate update;

    public SendPositionUpdate(String username,String password,PositionUpdate update,@NonNull RequestListener listener){
        this.username = username;
        this.password = password;
        this.listener = listener;
        this.update = update;
    }

    @Override
    protected String doInBackground(Void... voids) {
        try {
            HttpURLConnection connection = (HttpURLConnection) new URL(url).openConnection();

            connection.setDoOutput(true);
            connection.setDoInput(true);
            connection.setRequestMethod("POST");

            Utils.addParametersToRequest(
                    new Uri.Builder()
                            .appendQueryParameter("username", username)
                            .appendQueryParameter("passwd", password)
                            .appendQueryParameter("movDate", update.getDate().toString())
                            .appendQueryParameter("movTime", update.getTime().toString())
                            .appendQueryParameter("latitude", String.valueOf(update.getLatitude()))
                            .appendQueryParameter("longitude", String.valueOf(update.getLongitude()))
                            .appendQueryParameter("speed", String.valueOf(update.getSpeed()))
                            .appendQueryParameter("shipment", String.valueOf(update.getShipment())),
                    connection);

            BufferedReader buffer = new BufferedReader(new InputStreamReader(connection.getInputStream()));
            StringBuilder result = new StringBuilder();
            String tmp;

            while ((tmp = buffer.readLine()) != null) {
                result.append(tmp);
                result.append("\n");
            }

            return result.toString();
        }catch (Exception e){
            e.printStackTrace();
        }

        return null;
    }

    @Override
    protected void onPostExecute(String s) {
        super.onPostExecute(s);
        Log.d("test",s);
        try {
            listener.onReceive(HttpResponseParser.parse(s));
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }
}
