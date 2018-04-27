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
     * @param keys
     * @return
     * @throws JSONException
     */
    public static HttpResponse parse(String json,String... keys) throws JSONException {
        JSONObject object = new JSONObject(json);
        JSONArray array = object.getJSONArray("params");
        List<String> params = new ArrayList<>();
        HttpResponse response = new HttpResponse(
                object.getInt("status"),
                object.getString("message"),
                object.getString("error")
        );

        if (array != null && keys.length != 0) {
            for (int i = 0; i < array.length(); i++) {
                if (i > keys.length){
                    break;
                }

                JSONObject obj = array.getJSONObject(i);
                params.add(obj.getString(keys[i]));
            }

            if (params.size() != 0) {
                response.setParameters((String[]) params.toArray());
            }
        }

        return response;
    }
}
