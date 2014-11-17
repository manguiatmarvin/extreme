package com.Xconvert.jobs;

import java.io.IOException;
import java.util.Scanner;
import java.util.regex.Pattern;

public class Convert{
	
	protected int id;
	protected String vsource;
	protected String vdestination;
	
	ProcessBuilder pb;
	Process p =null;
	
	public Convert(int id, String src, String dest){
		System.out.println("Convertion initialized...");
		this.vsource = src;
		this.vdestination = dest;
		this.id = id;
		this.pb = new ProcessBuilder("ffmpeg","-i",this.getVsource() ,this.getVdestination(),"-y");
		
	    try {
			 this.p = this.pb.start();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	
	public int startConvert() {
		// TODO Auto-generated method stub
		  Scanner sc = new Scanner(this.p.getErrorStream());
		  
		   // Find duration
          Pattern durPattern = Pattern.compile("(?<=Duration: )[^,]*");
          String dur = sc.findWithinHorizon(durPattern, 0);
          if (dur == null)
            throw new RuntimeException("Could not parse duration.");
          String[] hms = dur.split(":");
          double totalSecs = Integer.parseInt(hms[0]) * 3600
                           + Integer.parseInt(hms[1]) *   60
                           + Double.parseDouble(hms[2]);
          System.out.println("Total duration: " + totalSecs + " seconds.");

          // Find time as long as possible.
          Pattern timePattern = Pattern.compile("(?<=time=)[\\d:.]*");
          String match;
          String[] matchSplit;
          while (null != (match = sc.findWithinHorizon(timePattern, 0))) {
              matchSplit = match.split(":");
              double progress = Integer.parseInt(matchSplit[0]) * 3600 +
                  Integer.parseInt(matchSplit[1]) * 60 +
                  Double.parseDouble(matchSplit[2]);
              progress = progress / totalSecs;
            System.out.printf("Progress: %.2f%%%n", progress * 100);
          }
          
       return this.getId();   
	}
	
	
	
	public String getVsource() {
		return vsource;
	}


	public void setVsource(String vsource) {
		this.vsource = vsource;
	}


	public String getVdestination() {
		return vdestination;
	}


	public void setVdestination(String vdestination) {
		this.vdestination = vdestination;
	}
	
	public int getId() {
		return id;
	}


	public void setId(int id) {
		this.id = id;
	}

}
