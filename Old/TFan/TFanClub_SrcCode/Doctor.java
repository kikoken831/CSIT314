package tFanClubProject;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.swing.table.TableModel;

import net.proteanit.sql.DbUtils;

public class Doctor {

	// retrieves the patient info
	public TableModel getPatient(String username) throws SQLException {
		Connection con = ConnectDatabase.getConnection();
		if (con != null) {
			PreparedStatement pst = null;
			ResultSet response = null;
			try {
				String query = " SELECT * FROM Patient where patientID=?";
				pst = con.prepareStatement(query);
				pst.setString(1, username);
				response = pst.executeQuery();
				return DbUtils.resultSetToTableModel(response);
			} catch (SQLException e) {
				System.out.println(e);
			} finally {
				if (pst != null) {
					pst.close();

				}
			}

		}
		return null;
	}

	// retrieves information of all patients
	public TableModel getAllPatients(int doctorID) throws SQLException {
		Connection con = ConnectDatabase.getConnection();
		if (con != null) {
			PreparedStatement pst = null;
			ResultSet response = null;
			try {
				String query = " SELECT Patient.patientID, patientFName,patientLName " + "FROM Patient "
						+ " INNER JOIN Doctor " + "ON Patient.patientID = Doctor.patientID "
						+ " WHERE Doctor.doctorID = ?";
				pst = con.prepareStatement(query);
				pst.setInt(1, doctorID);
				response = pst.executeQuery();
				return DbUtils.resultSetToTableModel(response);
			} catch (SQLException e) {
				System.out.println(e);
			} finally {
				if (pst != null) {
					pst.close();

				}

			}
		}
		return null;
	}

	// retrieves the information of patient by patient id
	public TableModel getPatientInfo(int patientId) throws SQLException {
		Connection con = ConnectDatabase.getConnection();
		if (con != null) {
			PreparedStatement pst = null;
			ResultSet response = null;
			try {
				String query = " SELECT datePrescribed AS DatePrescribed, medicationName AS Medication, dosage FROM Patient "
						+ " INNER JOIN Prescription ON PATIENT.patientID = PRESCRIPTION.patientID "
						+ " where PATIENT.patientID = ?";
				pst = con.prepareStatement(query);
				pst.setInt(1, patientId);
				response = pst.executeQuery();
				return DbUtils.resultSetToTableModel(response);
			} catch (SQLException e) {
				System.out.println(e);
			} finally {
				if (pst != null) {
					pst.close();
				}
			}
		}
		return null;
	}
	// retrieves the information of patient by patient id
		public TableModel getPatientEmail(int patientId) throws SQLException {
			Connection con = ConnectDatabase.getConnection();
			if (con != null) {
				PreparedStatement pst = null;
				ResultSet response = null;
				try {
					String query = " Select patientEmail, patientFName FROM Patient "
							+ " where PATIENT.patientID = ?";
					pst = con.prepareStatement(query);
					pst.setInt(1, patientId);
					response = pst.executeQuery();
					return DbUtils.resultSetToTableModel(response);
				} catch (SQLException e) {
					System.out.println(e);
				} finally {
					if (pst != null) {
						pst.close();
					}
				}
			}
			return null;
		}

	// retrieves the patient's fullname
	public String getPatientName(int patientId) throws SQLException {
		Connection con = ConnectDatabase.getConnection();
		if (con != null) {
			PreparedStatement pst = null;
			ResultSet response = null;
			try {

				String query = " SELECT patientFName||' '||patientLName AS patientName FROM Patient where patientID=?";
				pst = con.prepareStatement(query);
				pst.setInt(1, patientId);
				response = pst.executeQuery();
				String patientName = "";
				while (response.next()) {
					patientName = response.getString("patientName");
				}
				return patientName;

			} catch (SQLException e) {
				System.out.println(e);
			} finally {
				if (pst != null) {
					pst.close();
				}

			}
		}
		return null;
	}

	// retrieves the prescription of the patient by patient id
	public TableModel getPrescription(int patientId, String prescriptionName) throws SQLException {
		Connection con = ConnectDatabase.getConnection();
		if (con != null) {
			PreparedStatement pst = null;
			ResultSet response = null;
			try {
				String query = " SELECT datePrescribed AS datePrescribed, medicationName AS medication, dosage AS dosage FROM Patient "
						+ " INNER JOIN Prescription ON PATIENT.patientID = PRESCRIPTION.patientID "
						+ " where PATIENT.patientID = ? AND Prescription.medicationName LIKE ?";
				pst = con.prepareStatement(query);
				pst.setInt(1, patientId);
				pst.setString(2, "%" + prescriptionName + "%");
				response = pst.executeQuery();
				return DbUtils.resultSetToTableModel(response);

			} catch (SQLException e) {
				System.out.println(e);
			} finally {
				if (pst != null) {
					pst.close();
				}

			}

		}
		return null;
	}


	// adds new prescription of the patient
	public String addPrescription(int patientId, String datePrescribed, String medication, int doctorID, String dosage, String token)
			throws SQLException {
		// generate token
		Connection con = ConnectDatabase.getConnection();
		if (con != null) {
			String query = " INSERT INTO Prescription(datePrescribed,patientID,medicationName,presStatus,doctorID,dosage,token) "
					+ " VALUES(?,?,?,?,?,?,?)";
			PreparedStatement pst = con.prepareStatement(query);  
			pst.setString(1, datePrescribed);
			pst.setInt(2, patientId);
			pst.setString(3, medication);
			pst.setString(4, "Pending");
			pst.setInt(5, doctorID);
			pst.setString(6, dosage);
			pst.setString(7, token);
			pst.executeUpdate();
			pst.close();
			return token;
		}

		return null;

	}

	// For homepagePharmacist
	public int getDoctorID(String username) throws SQLException {

		int doctorID = 0;
		Connection con = ConnectDatabase.getConnection();
		if (con != null) {
			String query = " SELECT doctorID FROM Doctor where username = ?";
			PreparedStatement pst = con.prepareStatement(query);
			pst.setString(1, username);

			// This gets the values back one by one from the database
			ResultSet response = pst.executeQuery();

			while (response.next()) {
				doctorID = response.getInt("doctorID");

			}
			pst.close();

		}
		return doctorID;

	}

	public int updateToken(int patientId) throws SQLException {
		Connection con = ConnectDatabase.getConnection();
		if (con != null) {
			PreparedStatement pst = null;
			int response = -1;
			try {
				String query = " UPDATE Prescription " + " SET token = hex(randomblob(16)) "
						+ " WHERE patientID = ? AND presStatus = 'Pending'";
				pst = con.prepareStatement(query);
				pst.setInt(1, patientId);
				response = pst.executeUpdate();
				return (response);

			} catch (SQLException e) {
				System.out.println(e);
			} finally {
				if (pst != null) {
					pst.close();
				}
			}

		}
		return -1;
	}
	
	

}
