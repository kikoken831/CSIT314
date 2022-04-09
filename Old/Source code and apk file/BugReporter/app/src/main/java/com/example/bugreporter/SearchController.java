package com.example.bugreporter;

import android.content.Context;

import java.util.ArrayList;

public class SearchController {
    Bug bug;
    User user;

    public SearchController(Context context)
    {
        bug = new Bug(context);
        user = new User(context);
    }

    public ArrayList<String> searchBug(String keyword){
        ArrayList<String> list = bug.searchBug(keyword);
        return list;
    }

    public ArrayList<String> searchMyBug(String keyword, String username){
        ArrayList<String> list = bug.searchMyBug(keyword, username);
        return list;
    }

    public ArrayList<String> searchPendingReviewBug(String keyword){
        ArrayList<String> list = bug.searchPendingReviewBug(keyword);
        return list;
    }

    public ArrayList<String> searchReviewedBug(String keyword){
        ArrayList<String> list = bug.searchReviewedBug(keyword);
        return list;
    }

    public ArrayList<String> searchUnassignedBug(String keyword){
        ArrayList<String> list = bug.searchUnassignedBug(keyword);
        return list;
    }

    public ArrayList<String> searchDeveloper(String keyword){
        ArrayList<String> list = user.searchDeveloper(keyword);
        return list;
    }

    public ArrayList<String> searchUnresolvedBug(String keyword){
        ArrayList<String> list = bug.searchUnassignedBug(keyword);
        return list;
    }

}
