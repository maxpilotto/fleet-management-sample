package com.maxpilotto.trucktr4ck3r.utils;

import android.net.Uri;

import java.io.BufferedWriter;
import java.io.IOException;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;

/**
 * Project: ACME
 * Created by: Max
 * Date: 27/04/2018 @ 19:40
 * Package: com.maxpilotto.acme.utils
 */
public class Utils {
    public static void addParametersToRequest(Uri.Builder uriBuilder, HttpURLConnection conn) throws IOException {
        String query = uriBuilder.build().getEncodedQuery();

        OutputStream os = conn.getOutputStream();
        BufferedWriter writer = new BufferedWriter(new OutputStreamWriter(os, "UTF-8"));
        writer.write(query);
        writer.close();
        os.close();
    }
}
