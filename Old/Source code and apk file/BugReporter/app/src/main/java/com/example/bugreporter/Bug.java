package com.example.bugreporter;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.readystatesoftware.sqliteasset.SQLiteAssetHelper;

import java.util.ArrayList;

public class Bug extends SQLiteAssetHelper
{
    private static final String DATABASE_NAME = "BugReporter";
    private static final int DATABASE_Version = 1;

    private static final String TABLE_BUG = "bug_table";
    private static final String bugid = "bug_id";
    private static final String bugtitle = "bug_title";
    private static final String bugDesc = "bug_desc";
    private static final String status = "status";
    private static final String reportedBy = "reported_by"; // bug reporter
    private static final String assignedTo = "assigned_to"; // developer
    private static final String allocatedBy = "allocated_by"; // triager
    private static final String reportedOn = "report_on"; // Date reported
    private static final String resolvedOn = "resolved_on"; // Date resolved
    private static final String caseStatus = "case_status"; // open/ pending review/ reviewed/ closed

    private Context context;

    public Bug(Context context){
        super(context, DATABASE_NAME, null, DATABASE_Version);
        this.context = context;
    }

    public ArrayList<String> allBug(){
        String query = "SELECT * FROM " + this.TABLE_BUG;
        Cursor cursor = this.getReadableDatabase().rawQuery(query, null);
        ArrayList<String> list = new ArrayList<String>();

        while (cursor.moveToNext())
        {
            list.add(("ID: " + cursor.getString(0) + "\n Bug Title: " + cursor.getString(1) + "\n Bug Description: " +
                    cursor.getString(2) + "\n Status: " + cursor.getString(3) + "\n Reported by: " + cursor.getString(4) +
                    "\n Assigned to: " + cursor.getString(5) + "\n Allocated by: " + cursor.getString(6) + "\n Reported On: " + cursor.getString(7)
                    + "\n Resolved On: " + cursor.getString(8) + "\n Case: " + cursor.getString(9)));
        }

        return list;
    }

    public long insert(ContentValues values)
    {
        long id = this.getWritableDatabase().insert(TABLE_BUG, null, values);
        return id;
    }

    public ArrayList<String> getBugsByDev(String username)
    {
        ArrayList<String> list = new ArrayList<String>();
        String query = "SELECT * FROM " + this.TABLE_BUG + " WHERE " + this.assignedTo + " = ?";
        String[] args = {username};

        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        while (cursor.moveToNext())
        {
            list.add(("ID: " + cursor.getString(0) + "\n Bug Title: " + cursor.getString(1) + "\n Bug Description: " +
                    cursor.getString(2) + "\n Status: " + cursor.getString(3) + "\n Reported by: " + cursor.getString(4) +
                    "\n Assigned to: " + cursor.getString(5) + "\n Allocated by: " + cursor.getString(6) + "\n Reported On: " + cursor.getString(7)
                    + "\n Resolved On: " + cursor.getString(8) + "\n Case: " + cursor.getString(9)));
        }

        return list;
    }

    public ArrayList<String> getBugsByDevAndCaseStatus(String username)
    {
        ArrayList<String> list = new ArrayList<String>();
        String query = "SELECT * FROM " + this.TABLE_BUG + " WHERE " + this.assignedTo + " = ? AND " + this.caseStatus + " = 'open'";
        String[] args = {username};

        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        while (cursor.moveToNext())
        {
            list.add(("ID: " + cursor.getString(0) + "\n Bug Title: " + cursor.getString(1) + "\n Bug Description: " +
                    cursor.getString(2) + "\n Status: " + cursor.getString(3) + "\n Reported by: " + cursor.getString(4) +
                    "\n Assigned to: " + cursor.getString(5) + "\n Allocated by: " + cursor.getString(6) + "\n Reported On: " + cursor.getString(7)
                    + "\n Resolved On: " + cursor.getString(8) + "\n Case: " + cursor.getString(9)));
        }

        return list;
    }

    public String getStatus(String bugid)
    {
        String query = "SELECT " + this.status +" FROM " + this.TABLE_BUG + " WHERE " + this.bugid + " = ?";
        String[] args = {bugid};

        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        cursor.moveToNext();
        String status = cursor.getString(0);

        return status;
    }

    public String getCaseStatus(String bugid)
    {
        String query = "SELECT " + this.caseStatus +" FROM " + this.TABLE_BUG + " WHERE " + this.bugid + " = ?";
        String[] args = {bugid};

        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        cursor.moveToNext();
        String caseStatus = cursor.getString(0);

        return caseStatus;
    }

    public String getAssignedTo(String bugid)
    {
        String query = "SELECT " + this.assignedTo + " FROM " + this.TABLE_BUG + " WHERE " + this.bugid + " = ?";
        String[] args = {bugid};

        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        cursor.moveToNext();
        String assignedTo = cursor.getString(0);

        return assignedTo;
    }

    public long update(ContentValues values, String bugid)
    {
        SQLiteDatabase sqlDB = this.getWritableDatabase();
        long rowid = sqlDB.update(this.TABLE_BUG, values, this.bugid + "=" + bugid, null);

        return rowid;
    }

    public ArrayList<String> getBugByStatus(String status)
    {
        ArrayList<String> list = new ArrayList<String>();
        String query = "SELECT * FROM " + this.TABLE_BUG + " WHERE " + this.status + " = ?";
        String[] args = {status};

        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        while (cursor.moveToNext())
        {
            list.add(("ID: " + cursor.getString(0) + "\n Bug Title: " + cursor.getString(1) + "\n Bug Description: " +
                    cursor.getString(2) + "\n Status: " + cursor.getString(3) + "\n Reported by: " + cursor.getString(4) +
                    "\n Assigned to: " + cursor.getString(5) + "\n Allocated by: " + cursor.getString(6) + "\n Reported On: " + cursor.getString(7)
                    + "\n Resolved On: " + cursor.getString(8) + "\n Case: " + cursor.getString(9)));
        }

        return list;
    }

    public ArrayList<String> getBugByCaseStatus(String caseStatus)
    {
        ArrayList<String> list = new ArrayList<String>();
        String query = "SELECT * FROM " + this.TABLE_BUG + " WHERE " + this.caseStatus + " = ?";
        String[] args = {caseStatus};

        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        while (cursor.moveToNext())
        {
            list.add(("ID: " + cursor.getString(0) + "\n Bug Title: " + cursor.getString(1) + "\n Bug Description: " +
                    cursor.getString(2) + "\n Status: " + cursor.getString(3) + "\n Reported by: " + cursor.getString(4) +
                    "\n Assigned to: " + cursor.getString(5) + "\n Allocated by: " + cursor.getString(6) + "\n Reported On: " + cursor.getString(7)
                    + "\n Resolved On: " + cursor.getString(8) + "\n Case: " + cursor.getString(9)));
        }

        return list;
    }

    public ArrayList<String> getNumberOfBugsReported(String startDate, String endDate)
    {
        String query = "SELECT COUNT(" + this.bugid + ") FROM " + this.TABLE_BUG + " WHERE DATE(" + this.reportedOn + ") BETWEEN ? AND ?";
        String[] args = {startDate, endDate};

        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        ArrayList<String> list = new ArrayList<String>();

        while (cursor.moveToNext())
        {
            list.add(("Number of bugs reported from " + startDate + " to " + endDate + ": "+ cursor.getString(0)));
        }

        return list;
    }

    public ArrayList<String> getNumberofBugsResolved(String startDate, String endDate)
    {
        String query = "SELECT COUNT(" + this.bugid + ") FROM " + this.TABLE_BUG + " WHERE  DATE(" + this.resolvedOn + ") BETWEEN DATE(?) AND DATE(?)";
        String[] args = {startDate, endDate};

        Cursor cursor = this.getReadableDatabase().rawQuery(query, args);

        ArrayList<String> list = new ArrayList<String>();

        while (cursor.moveToNext())
        {
            list.add(("Number of bugs resolved from " + startDate + " to " + endDate + ": "+ cursor.getString(0)));
        }

        return list;
    }

    public ArrayList<String> getBestPerformedDeveloper(){
        String query = "SELECT "+ this.assignedTo + ", COUNT(" + this.bugid + ") FROM " + this.TABLE_BUG + " WHERE " +
                this.status + " = 'resolved'" +" GROUP BY " + this.assignedTo + " ORDER BY " + "COUNT(" + this.bugid + ") DESC";

        Cursor cursor = this.getReadableDatabase().rawQuery(query, null);

        ArrayList<String> list = new ArrayList<String>();

        while (cursor.moveToNext())
        {
            list.add(("Developer's username: " + cursor.getString(0) + "\n Number of bugs solved: " + cursor.getString(1)));
        }

        return list;
    }

    public ArrayList<String> getBestPerformedReporter(){
        String query = "SELECT "+ this.reportedBy + ", COUNT(" + this.bugid + ") FROM " + this.TABLE_BUG + " GROUP BY " + this.reportedBy +
                " ORDER BY " + "COUNT(" + this.bugid + ") DESC";

        Cursor cursor = this.getReadableDatabase().rawQuery(query, null);

        ArrayList<String> list = new ArrayList<String>();

        while (cursor.moveToNext())
        {
            list.add(("Reporter's username: " + cursor.getString(0) + "\n Number of bugs reported: " + cursor.getString(1)));
        }

        return list;
    }

    public ArrayList<String> searchBug(String keyword){
        String query = "SELECT * FROM "+ this.TABLE_BUG + " WHERE " + this.bugid + " = '" + keyword +"' OR " +
                this.bugtitle + " = '" + keyword + "' OR " +
                this.bugDesc + " = '" + keyword + "' OR " +
                this.status + " = '" + keyword + "' OR " +
                this.reportedBy + " = '" + keyword + "' OR " +
                this.assignedTo + " = '" + keyword + "' OR " +
                this.allocatedBy + " = '" + keyword + "' OR " +
                this.reportedOn + " = '" + keyword + "' OR " +
                this.resolvedOn + " = '" + keyword + "' OR " +
                this.caseStatus + " = '" + keyword + "';";

        Cursor cursor = this.getReadableDatabase().rawQuery(query, null);

        ArrayList<String> list = new ArrayList<String>();

        while (cursor.moveToNext())
        {
            list.add(("ID: " + cursor.getString(0) + "\n Bug Title: " + cursor.getString(1) + "\n Bug Description: " +
                    cursor.getString(2) + "\n Status: " + cursor.getString(3) + "\n Reported by: " + cursor.getString(4) +
                    "\n Assigned to: " + cursor.getString(5) + "\n Allocated by: " + cursor.getString(6) + "\n Reported On: " + cursor.getString(7)
                    + "\n Resolved On: " + cursor.getString(8) + "\n Case: " + cursor.getString(9)));
        }

        return list;
    }

    public ArrayList<String> searchMyBug(String keyword, String username){
        String query = "SELECT * FROM "+ this.TABLE_BUG + " WHERE " + this.assignedTo + " = '" + username +"' AND (" +
                this.bugtitle + " = '" + keyword + "' OR " +
                this.bugDesc + " = '" + keyword + "' OR " +
                this.status + " = '" + keyword + "' OR " +
                this.reportedBy + " = '" + keyword + "' OR " +
                this.bugid + " = '" + keyword + "' OR " +
                this.allocatedBy + " = '" + keyword + "' OR " +
                this.reportedOn + " = '" + keyword + "' OR " +
                this.resolvedOn + " = '" + keyword + "' OR " +
                this.caseStatus + " = '" + keyword + "');";

        Cursor cursor = this.getReadableDatabase().rawQuery(query, null);

        ArrayList<String> list = new ArrayList<String>();

        while (cursor.moveToNext())
        {
            list.add(("ID: " + cursor.getString(0) + "\n Bug Title: " + cursor.getString(1) + "\n Bug Description: " +
                    cursor.getString(2) + "\n Status: " + cursor.getString(3) + "\n Reported by: " + cursor.getString(4) +
                    "\n Assigned to: " + cursor.getString(5) + "\n Allocated by: " + cursor.getString(6) + "\n Reported On: " + cursor.getString(7)
                    + "\n Resolved On: " + cursor.getString(8) + "\n Case: " + cursor.getString(9)));
        }

        return list;
    }

    public ArrayList<String> searchPendingReviewBug(String keyword){
        String query = "SELECT * FROM "+ this.TABLE_BUG + " WHERE " + this.caseStatus + " = 'pending review' AND (" +
                this.bugtitle + " = '" + keyword + "' OR " +
                this.bugDesc + " = '" + keyword + "' OR " +
                this.status + " = '" + keyword + "' OR " +
                this.reportedBy + " = '" + keyword + "' OR " +
                this.bugid + " = '" + keyword + "' OR " +
                this.allocatedBy + " = '" + keyword + "' OR " +
                this.reportedOn + " = '" + keyword + "' OR " +
                this.resolvedOn + " = '" + keyword + "' OR " +
                this.assignedTo + " = '" + keyword + "');";

        Cursor cursor = this.getReadableDatabase().rawQuery(query, null);

        ArrayList<String> list = new ArrayList<String>();

        while (cursor.moveToNext())
        {
            list.add(("ID: " + cursor.getString(0) + "\n Bug Title: " + cursor.getString(1) + "\n Bug Description: " +
                    cursor.getString(2) + "\n Status: " + cursor.getString(3) + "\n Reported by: " + cursor.getString(4) +
                    "\n Assigned to: " + cursor.getString(5) + "\n Allocated by: " + cursor.getString(6) + "\n Reported On: " + cursor.getString(7)
                    + "\n Resolved On: " + cursor.getString(8) + "\n Case: " + cursor.getString(9)));
        }

        return list;
    }

    public ArrayList<String> searchReviewedBug(String keyword){
        String query = "SELECT * FROM "+ this.TABLE_BUG + " WHERE " + this.caseStatus + " = 'reviewed' AND (" +
                this.bugtitle + " = '" + keyword + "' OR " +
                this.bugDesc + " = '" + keyword + "' OR " +
                this.status + " = '" + keyword + "' OR " +
                this.reportedBy + " = '" + keyword + "' OR " +
                this.bugid + " = '" + keyword + "' OR " +
                this.allocatedBy + " = '" + keyword + "' OR " +
                this.reportedOn + " = '" + keyword + "' OR " +
                this.resolvedOn + " = '" + keyword + "' OR " +
                this.assignedTo + " = '" + keyword + "');";

        Cursor cursor = this.getReadableDatabase().rawQuery(query, null);

        ArrayList<String> list = new ArrayList<String>();

        while (cursor.moveToNext())
        {
            list.add(("ID: " + cursor.getString(0) + "\n Bug Title: " + cursor.getString(1) + "\n Bug Description: " +
                    cursor.getString(2) + "\n Status: " + cursor.getString(3) + "\n Reported by: " + cursor.getString(4) +
                    "\n Assigned to: " + cursor.getString(5) + "\n Allocated by: " + cursor.getString(6) + "\n Reported On: " + cursor.getString(7)
                    + "\n Resolved On: " + cursor.getString(8) + "\n Case: " + cursor.getString(9)));
        }

        return list;
    }

    public ArrayList<String> searchUnassignedBug(String keyword){
        String query = "SELECT * FROM "+ this.TABLE_BUG + " WHERE " + this.assignedTo + " = 'unassigned' AND (" +
                this.bugtitle + " = '" + keyword + "' OR " +
                this.bugDesc + " = '" + keyword + "' OR " +
                this.status + " = '" + keyword + "' OR " +
                this.reportedBy + " = '" + keyword + "' OR " +
                this.bugid + " = '" + keyword + "' OR " +
                this.allocatedBy + " = '" + keyword + "' OR " +
                this.reportedOn + " = '" + keyword + "' OR " +
                this.resolvedOn + " = '" + keyword + "' OR " +
                this.caseStatus + " = '" + keyword + "');";

        Cursor cursor = this.getReadableDatabase().rawQuery(query, null);

        ArrayList<String> list = new ArrayList<String>();

        while (cursor.moveToNext())
        {
            list.add(("ID: " + cursor.getString(0) + "\n Bug Title: " + cursor.getString(1) + "\n Bug Description: " +
                    cursor.getString(2) + "\n Status: " + cursor.getString(3) + "\n Reported by: " + cursor.getString(4) +
                    "\n Assigned to: " + cursor.getString(5) + "\n Allocated by: " + cursor.getString(6) + "\n Reported On: " + cursor.getString(7)
                    + "\n Resolved On: " + cursor.getString(8) + "\n Case: " + cursor.getString(9)));
        }

        return list;
    }

    public ArrayList<String> searchUnresolvedBug(String keyword){
        String query = "SELECT * FROM "+ this.TABLE_BUG + " WHERE " + this.status + " = 'unresolved' AND (" +
                this.bugtitle + " = '" + keyword + "' OR " +
                this.bugDesc + " = '" + keyword + "' OR " +
                this.assignedTo + " = '" + keyword + "' OR " +
                this.reportedBy + " = '" + keyword + "' OR " +
                this.bugid + " = '" + keyword + "' OR " +
                this.allocatedBy + " = '" + keyword + "' OR " +
                this.reportedOn + " = '" + keyword + "' OR " +
                this.resolvedOn + " = '" + keyword + "' OR " +
                this.caseStatus + " = '" + keyword + "');";

        Cursor cursor = this.getReadableDatabase().rawQuery(query, null);

        ArrayList<String> list = new ArrayList<String>();

        while (cursor.moveToNext())
        {
            list.add(("ID: " + cursor.getString(0) + "\n Bug Title: " + cursor.getString(1) + "\n Bug Description: " +
                    cursor.getString(2) + "\n Status: " + cursor.getString(3) + "\n Reported by: " + cursor.getString(4) +
                    "\n Assigned to: " + cursor.getString(5) + "\n Allocated by: " + cursor.getString(6) + "\n Reported On: " + cursor.getString(7)
                    + "\n Resolved On: " + cursor.getString(8) + "\n Case: " + cursor.getString(9)));
        }

        return list;
    }

    public String TABLE_BUG()
    {
        return TABLE_BUG;
    }

    public String bugid()
    {
        return bugid;
    }

    public String bugtitle()
    {
        return bugtitle;
    }

    public String bugDesc()
    {
        return bugDesc;
    }

    public String status()
    {
        return status;
    }

    public String reportedBy()
    {
        return reportedBy;
    }

    public String assignedTo()
    {
        return assignedTo;
    }

    public String allocatedBy()
    {
        return allocatedBy;
    }

    public String reportedOn()
    {
        return reportedOn;
    }

    public String resolvedOn()
    {
        return resolvedOn;
    }

    public String caseStatus()
    {
        return caseStatus;
    }
}