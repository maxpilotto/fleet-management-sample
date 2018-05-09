package com.maxpilotto.acme.utils;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

/**
 * Project: ACME
 * Created by: Max
 * Date: 27/04/2018 @ 17:09
 * Package: com.maxpilotto.acme.utils
 */
public class HttpResponseParser {

    /**
     * Returns an HttpResponse object that contains the response sent from the ACME web service,
     * @param json
     * @throws JSONException
     */
    public static HttpResponse parse(String json) throws JSONException {
        JSONObject object = new JSONObject(json);
        HttpResponse response = new HttpResponse(
                object.getInt("status"),
                object.getString("message"),
                object.getString("error")
        );

        response.setObject(object);

        return response;
    }
}
