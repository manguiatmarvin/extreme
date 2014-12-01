package com.Xconvert.server;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

import com.Xconvert.models.EncodingJobs;

public class JobsDAO {
	Connection connection;
	Statement stmt;
	private int noOfRecords;

	public JobsDAO() {

	}

	private static Connection getConnection() throws SQLException,
			ClassNotFoundException {
		Connection con = (Connection) ConnectionFactory.getInstance()
				.getConnection();
		return con;
	}

	public Boolean UpdatePendingJob(int job_id, String status) {

		String query = "Update encodingJobs set status = '" + status
				+ "' WHERE  job_id = " + job_id;
	

		try {
			connection = getConnection();
			stmt = connection.createStatement();
			stmt.executeUpdate(query);

		} catch (SQLException e) {
			e.printStackTrace();
		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} finally {
			try {
				if (stmt != null)
					stmt.close();
				if (connection != null)
					connection.close();
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}

		return true;
	}

	public List<EncodingJobs> getLatestPendingJobs(int noOfRecords) {

		String query = "select  * from encodingJobs where status = 'pending' limit "
				+ noOfRecords;

		List<EncodingJobs> jobQ = new ArrayList<EncodingJobs>();
		EncodingJobs encodingJob = null;
		try {
			connection = getConnection();
			stmt = connection.createStatement();
			ResultSet rs = stmt.executeQuery(query);
			while (rs.next()) {
				encodingJob = new EncodingJobs();
				encodingJob.setJob_id(rs.getInt("job_id"));
				encodingJob.setSource(rs.getString("source"));
				encodingJob.setDestination(rs.getString("destination"));
				encodingJob.setThumbnail1(rs.getString("thumbnail1"));
				encodingJob.setStatus(rs.getString("status"));
				encodingJob.setCreated(rs.getDate("created"));
				jobQ.add(encodingJob);
			}
			rs.close();

		} catch (SQLException e) {
			e.printStackTrace();
		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		} finally {
			try {
				if (stmt != null)
					stmt.close();
				if (connection != null)
					connection.close();
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}
		return jobQ;
	}

	public int getNoOfRecords() {
		return noOfRecords;
	}
}
