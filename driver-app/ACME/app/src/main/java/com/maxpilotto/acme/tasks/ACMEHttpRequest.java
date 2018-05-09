package com.maxpilotto.acme.tasks;

import android.os.AsyncTask;
import android.support.annotation.NonNull;
import android.util.Log;

import com.maxpilotto.acme.utils.ACMEHttpResponseListener;
import com.maxpilotto.acme.utils.HttpResponseParser;

import org.json.JSONException;

/**
 * Project: ACME
 * Created by: Max
 * Date: 27/04/2018 @ 18:03
 * Package: com.maxpilotto.acme.tasks
 */
public class ACMEHttpRequest extends AsyncTask<Void, Void, String> {
    private ACMEHttpResponseListener listener;
    protected String username;
    protected String password;

    public ACMEHttpRequest(String username, String password, @NonNull ACMEHttpResponseListener listener) {
        this.username = username;
        this.password = password;
        this.listener = listener;
    }

    @Override
    protected String doInBackground(Void... voids) {
        return null;
    }

    @Override
    protected void onPostExecute(String s) {
        super.onPostExecute(s);

        listener.onResponseReceived(s);
    }
}
