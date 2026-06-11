-- AI Severity Prediction columns for the `complaint` table.
-- Idempotent: safe to run on a fresh database to set up the feature.
-- (On this project's DB these columns already exist.)

ALTER TABLE `complaint`
  ADD COLUMN IF NOT EXISTS `severity`            VARCHAR(10) NULL DEFAULT 'unknown',
  ADD COLUMN IF NOT EXISTS `engines_recommended` INT(11)     NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `threat_level`        VARCHAR(20) NULL DEFAULT '',
  ADD COLUMN IF NOT EXISTS `fire_type`           VARCHAR(50) NULL DEFAULT '',
  ADD COLUMN IF NOT EXISTS `ai_confidence`       FLOAT       NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS `ai_timestamp`        TIMESTAMP   NULL DEFAULT NULL;

-- Meaning of `severity`:
--   'unknown'  -> AI did not run (service down / failed)   [engines = 0]
--   'None'     -> AI ran, no clear fire detected           [engines = 0]
--   'Low'      -> small fire                                [engines = 1]
--   'Medium'   -> moderate fire                             [engines = 2]
--   'High'     -> severe fire                               [engines = 4]
