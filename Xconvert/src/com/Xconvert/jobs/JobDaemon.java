package com.Xconvert.jobs;

import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Date;

import org.quartz.Job;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;



public class JobDaemon implements Job{

	@Override
	public void execute(JobExecutionContext jec) throws JobExecutionException {
		// TODO Auto-generated method stub
		System.out.println("Checking database for pending job...");
		
		  String myDriver = "com.mysql.jdbc.Driver";
	      String myUrl = "jdbc:mysql://localhost/edplayground";
	      java.sql.Statement stmtSelect;
	      java.sql.Statement stmtUpdate;
	      ResultSet rs;
	      Convert c;
	      try {
	    	 
	    	Class.forName(myDriver);
			java.sql.Connection conn = DriverManager.getConnection(myUrl, "root", "secret123");
			
			stmtSelect = conn.createStatement() ;
			stmtUpdate = conn.createStatement() ;
			
			String selectQuery = "Select * from encodingJobs where status = 'pending'" ;
			  rs = stmtSelect.executeQuery(selectQuery) ;
		
			while (rs.next()){
		        int id = rs.getInt("id");
		        String source = rs.getString("source");
		        String destination = rs.getString("destination");
		        Date dateCreated = rs.getDate("created");
		        String status  = rs.getString("status");
		        String command  = rs.getString("command");
		        
		        // print the results
		        System.out.format("%s, %s, %s, %s, %s,\n", id, source, destination, status, command);
		       
		        stmtUpdate.executeUpdate("UPDATE  `edplayground`.`encodingJobs` SET  `status` =  'processing' WHERE  `encodingJobs`.`id` = "+id);
		        c = new Convert(id, source, destination);
		        c.startConvert();
		
		        
		        if(c != null){
		        	stmtUpdate.executeUpdate("UPDATE  `edplayground`.`encodingJobs` SET  `status` =  'completed' WHERE  `encodingJobs`.`id` = "+id);
		        	
		        }
		        
		        
			}
			stmtSelect.close();
			System.out.println("closing connection...");  
			  
		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	     
	}

}
