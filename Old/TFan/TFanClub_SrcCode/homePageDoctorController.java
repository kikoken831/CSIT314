package tFanClubProject;

import java.sql.SQLException;

import javax.swing.table.TableModel;

public class homePageDoctorController {

	public TableModel getPatientInfo(int patientId) throws SQLException {
		Doctor doc1 = new Doctor();
		TableModel username = doc1.getPatientInfo(patientId);
		return username;
	}

	public int getDoctorID(String username) throws SQLException {
		Doctor doc1 = new Doctor();
		int id = doc1.getDoctorID(username);
		return id;
	}

	public String getPatientName(int patientId) {
		// TODO Auto-generated method stub
		return null;
	}

	public TableModel getPatient(String text) throws SQLException {
		Doctor doc1 = new Doctor();
		TableModel username = doc1.getPatient(text);
		return username;
	}

	public static TableModel getAllPatients(int doctorID) throws SQLException {
		Doctor doc1 = new Doctor();
		TableModel username = doc1.getAllPatients(doctorID);
		return username;
	}

}
