pipeline {
  agent any
  stages {
    stage('Upload Patches') {
      parallel {
        stage('Upload Patches') {
          steps {
            sh 'echo -e "Patch successfully uploaded.";'
          }
        }

        stage('Unzip Patch') {
          steps {
            sh 'echo "Unzipped"'
          }
        }

      }
    }

    stage('Completed') {
      steps {
        echo 'Successfully Completed.'
      }
    }

  }
}