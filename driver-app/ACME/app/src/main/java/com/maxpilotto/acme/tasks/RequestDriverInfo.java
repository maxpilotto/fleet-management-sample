package com.maxpilotto.acme.tasks;

import android.net.Uri;
import android.os.AsyncTask;
import android.support.annotation.NonNull;

import com.maxpilotto.acme.utils.HttpResponse;
import com.maxpilotto.acme.utils.HttpResponseParser;
import com.maxpilotto.acme.utils.Utils;

import org.json.JSONException;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

/**
 * Project: ACME
 * Created by: Max
 * Date: 27/04/2018 @ 18:00
 * Package: com.maxpilotto.acme.tasks
 */
public class RequestDriverInfo extends AsyncTask<Void,Void,String> {
    public interface RequestListener{
        void onReceive(HttpResponse response);
    }

    private RequestListener listener;
    private String username;
    private String password;


    public RequestDriverInfo(String username, String password, @NonNull RequestListener listener) {
        this.username = username;
        this.password = password;
        this.listener = listener;
    }

    @Override
    protected String doInBackground(Void... voids) {
        try {
            // NOTE To access the database on the same machine the address is note 127.0.0.1 or localhost, it's 10.0.2.2
            // Reference: https://developer.android.com/studio/run/emulator-networking
            // TODO change the url

            HttpURLConnection connection = (HttpURLConnection) new URL("http://10.0.2.2:80/fleet-management-sample/site/service/requestDriverInfo.php").openConnection();

            connection.setDoOutput(true);
            connection.setDoInput(true);
            connection.setRequestMethod("POST");

            Utils.addParametersToRequest(
                    new Uri.Builder()
                            .appendQueryParameter("username", username)
                            .appendQueryParameter("passwd", password),
                    connection);

            BufferedReader buffer = new BufferedReader(new InputStreamReader(connection.getInputStream()));
            StringBuilder result = new StringBuilder();
            String tmp;

            while ((tmp = buffer.readLine()) != null) {
                result.append(tmp);
                result.append("\n");
            }

            return result.toString();
        } catch (IOException e) {
            e.printStackTrace();
        }

        return null;
    }

    @Override
    protected void onPostExecute(String s) {
        super.onPostExecute(s);

        try {
            listener.onReceive(HttpResponseParser.parse(s));
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }
}
