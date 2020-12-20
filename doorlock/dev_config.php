<?xml version="1.0" encoding="UTF-8"?>
<!--
   Licensed to the Apache Software Foundation (ASF) under one or more
   contributor license agreements.  See the NOTICE file distributed with
   this work for additional information regarding copyright ownership.
   The ASF licenses this file to You under the Apache License, Version 2.0
   (the "License"); you may not use this file except in compliance with
   the License.  You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
-->
<!--
  This POM has been created manually by the Ant Development Team.
  Please contact us if you are not satisfied with the data contained in this POM.
  URL : http://ant.apache.org
-->
<project xmlns="http://maven.apache.org/POM/4.0.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://maven.apache.org/POM/4.0.0 http://maven.apache.org/maven-v4_0_0.xsd">
	<modelVersion>4.0.0</modelVersion>
	<groupId>org.apache.ant</groupId>
	<artifactId>ant-parent</artifactId>
	<version>1.10.5</version>
	<packaging>pom</packaging>
	<description>master POM</description>
	<name>Apache Ant</name>
	<modules>
		<module>ant</module>
		<module>ant-antlr</module>
		<module>ant-apache-bcel</module>
		<module>ant-apache-bsf</module>
		<module>ant-apache-log4j</module>
		<module>ant-apache-oro</module>
		<module>ant-apache-regexp</module>
		<module>ant-apache-resolver</module>
		<module>ant-apache-xalan2</module>
		<module>ant-commons-logging</module>
		<module>ant-commons-net</module>
		<module>ant-jai</module>
		<module>ant-javamail</module>
		<module>ant-jdepend</module>
		<module>ant-jmf</module>
		<module>ant-jsch</module>
		<module>ant-junit</module>
		<module>ant-junit4</module>
		<module>ant-junitlauncher</module>
		<module>ant-launcher</module>
		<module>ant-netrexx</module>
		<module>ant-swing</module>
		<module>ant-testutil</module>
		<module>ant-xz</module>
	</modules>
	<dependencies>
		<dependency>
			<groupId>junit</groupId>
			<artifactId>junit</artifactId>
			<version>4.x</version>
			<scope>test</scope>
		</dependency>
	</dependencies>
	<properties>
		<project.build.sourceEncoding>UTF-8</project.build.sourceEncoding>
		
			<debian.junit.junit.originalVersion>4.12</debian.junit.junit.originalVersion>
		
			<debian.mavenRules>s/ant/org.apache.ant/ * * s/.*/debian/ * *</debian.mavenRules>
		
			<debian.originalVersion>1.10.5</debian.originalVersion>
		
			<debian.package>ant</debian.package>
	</properties>
</project>